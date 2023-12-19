<?php
@session_start();
class engine
{
    public const VIEW_SUFFIX = 'engine';
    public array $config;
    public string $view;
    public string $viewName;
    public string $viewPath;
    public array $data;
    public array $sections = [];
    public function __construct($config)
    {
        $this->config = $config;
    }
    public function view(string $viewname, array $data = [], $extends = false)
    {
        extract($data);
        if (!$extends) {
            $this->viewName = $viewname;
            $this->viewPath = $this->config["views"] . "/" . $this->parsViewName($viewname);
            $this->data = $data;
        }
        $viewPath = $this->config["views"] . "/" . $this->parsViewName($viewname);
        if (!file_exists($viewPath)) {
            throw new Error('View Dosyası Bulunamdı = ' . $viewPath);
        }
        $this->view = file_get_contents($viewPath);
        $this->parse();
        $cachePatch = $this->config['cache'] . '/' . md5($this->viewName) . '.cache.php';
        if (!file_exists($cachePatch)) {
            echo '<!--- Cache Oluşuturuldu -->';
            file_put_contents($cachePatch, $this->view);
        }
        if (filemtime($cachePatch) < filemtime($viewPath)) {
            echo '<!--- Cache Temizliği Yapıldı -->';
            file_put_contents($cachePatch, $this->view);
        }
        ob_start();
        require $cachePatch;
        return ob_get_clean();
    }
    /**
     * @param string $name
     * @return string
     */
    public function parsViewName(string $name): string
    {
        $viewName = str_replace(".", "/", $name);
        return $viewName . '.' . ($this->config['suffix'] ?? self::VIEW_SUFFIX) . '.php';
    }
    /**
     * @return void
     */
    public function parse(): void
    {
        $this->parseComponent();
        $this->parseIncludes();
        $this->parseVariables();
        $this->parsePhp();
        $this->parseForEach();
        $this->parseSections();
        $this->parseExtends();
        $this->parseComponent();
        $this->parseYields();
        $this->parseIfBlocks();
        $this->parseUnEmpty();
        $this->parseEmpty();
        $this->parseToken();
        $this->parseComponent();
        $this->parseToken();
        $this->parseForLoop();
    }
    public function parseIfBlocks()
    {
        $this->view = preg_replace('/@(else|)if\((.*?)\)/', '<?php $1if ($2): ?>', $this->view);
        $this->view = preg_replace('/@else/', '<?php else: ?>', $this->view);
        $this->view = preg_replace('/@endif/', '<?php endif; ?>', $this->view);
    }
    public function parseEmpty()
    {
        $this->view = preg_replace_callback('/@empty\((.*?)\)/', function ($expression) {
            return '<?php if (empty(' . $expression[1] . ')): ?>';
        }, $this->view);
        $this->view = preg_replace('/@endempty/', '<?php endif; ?>', $this->view);
    }
    public function parseUnEmpty()
    {
        $this->view = preg_replace_callback('/@unempty\((.*?)\)/', function ($expression) {
            return '<?php if (!empty(' . $expression[1] . ')): ?>';
        }, $this->view);
        $this->view = preg_replace('/@endunempty/', '<?php endif; ?>', $this->view);
    }
    public function parseVariables()
    {
        $this->view = preg_replace_callback('/{{(.*?)}}/', function ($varaible) {
            return '<?=' . trim($varaible[1]) . '?>';
        }, $this->view);
    }
    public function parseForEach()
    {
        $this->view = preg_replace_callback('/@foreach\((.*?)\)/', function ($expression) {
            return '<?php foreach(' . $expression[1] . '): ?>';
        }, $this->view);
        $this->view = preg_replace('/@endforeach/', '<?php endforeach;?>', $this->view);
    }
    public function parseForLoop()
    {
        $this->view = preg_replace_callback('/@for\(([^)]*)\)/', function ($matches) {
            return '<?php for(' . $matches[1] . '): ?>';
        }, $this->view);

        $this->view = preg_replace('/@endfor/', '<?php endfor; ?>', $this->view);
    }

    public function parseComponent()
    {
        $desen = '/@component\(["\']([^,"\']+?)["\'](?:,["\']([^,"\']+?)["\'])?\)/';
        $this->view = preg_replace_callback($desen, function ($expression) {
            require_once __DIR__ . "/../theme/" . mb_strtoupper($this->config["themename"], "UTF-8") . ".php";
            $componentName = $expression[1];
            $componentParam = isset($expression[2]) ? $expression[2] : null;

            if (method_exists($this->config["themename"], $componentName)) {
                $componentContent = $componentParam !== null ?
                    call_user_func([new $this->config["themename"], $componentName], $componentParam) :
                    call_user_func([new $this->config["themename"], $componentName]);

                // Önce @section içeriklerini işle
                $this->parseSectionsInComponent($componentContent);

                return $componentContent;
            } else {
                return $componentName . ' componenti bulunamadı';
            }
        }, $this->view);
    }

    private function parseSectionsInComponent(&$content)
    {
        $content = preg_replace_callback('/@section\(\'(.*?)\', \'(.*?)\'\)/', function ($sectionDetail) {
            $this->sections[$sectionDetail[1]] = $sectionDetail[2];
            return '';
        }, $content);

        $content = preg_replace_callback('/@section\(\'(.*?)\'\)(.*?)@endsection/s', function ($sectionName) {
            $this->sections[$sectionName[1]] = $sectionName[2];
            return '';
        }, $content);
    }
    public function parseIncludes()
    {
        $this->view = preg_replace_callback('/@include\(\'(.*?)\'\)/', function ($viewName) {
            return file_get_contents($this->config["views"] . '/' . $this->parsViewName($viewName[1]));
            //var_dump($this->parsViewName($viewName[1]));
        }, $this->view);
    }
    public function parseToken()
    {
        $this->view = preg_replace_callback(
            '/@token\(\'(.*?)\'(?:,\s*(\d+))?\)/',
            function ($matches) {
                $sessionKey = $matches[1];
                $timeoutInSeconds = isset($matches[2]) ? (int) $matches[2] : 300;
                $this->generateToken($sessionKey, $timeoutInSeconds);
                $tokenValue = $_SESSION[$sessionKey]['token'] ?? '';
                return '<input id="token" type="hidden" name="' . $sessionKey . '" value="' . $tokenValue . '">';
            },
            $this->view
        );
    }
    public function generateToken($sessionKey, $timeoutInSeconds = 300)
    {
        // Oluşturulan token'ın rastgele bir değer ve sürenin birleşimi olduğunu varsayıyoruz.
        $tokenValue = bin2hex(random_bytes(32)); // Güvenli bir şekilde rastgele bir token oluşturuluyor.
        $_SESSION[$sessionKey] = [
            'token' => $tokenValue,
            'expires' => time() + $timeoutInSeconds // Geçerlilik süresini belirtiyoruz.
        ];
    }
    public function verifyToken($sessionKey, $receivedToken)
    {
    }
    public function parseExtends()
    {
        $this->view = preg_replace_callback('/@extends\(\'(.*?)\'\)/', function ($viewName) {
            return $this->view($viewName[1], $this->data, true);
        }, $this->view);
    }
    public function parseYields()
    {
        $this->view = preg_replace_callback('/@yield\(\'(.*?)\'\)/', function ($yieldName) {
            return $this->sections[$yieldName[1]] ?? '';
        }, $this->view);
    }
    public function parseSections()
    {
        $this->view = preg_replace_callback('/@section\(\'(.*?)\', \'(.*?)\'\)/', function ($sectionDetail) {
            $this->sections[$sectionDetail[1]] = $sectionDetail[2];
            return '';
        }, $this->view);
        $this->view = preg_replace_callback('/@section\(\'(.*?)\'\)(.*?)@endsection/s', function ($sectionName) {
            $this->sections[$sectionName[1]] = $sectionName[2];
            return '';
        }, $this->view);
    }
    public function parsePhp()
    {
        $this->view = preg_replace_callback('/@php\s*(.*?)\s*@endphp/s', function ($phpCode) {
            return '<?php ' . trim($phpCode[1]) . ' ?>';
        }, $this->view);
    }
    public function cacheClear()
    {
        $klasor_yolu = $this->config["cache"] . '/';
        if (is_dir($klasor_yolu)) {
            $dosyalar = scandir($klasor_yolu);
            foreach ($dosyalar as $dosya) {
                if ($dosya != '.' && $dosya != '..') {
                    $dosya_yolu = $klasor_yolu . $dosya;
                    if (is_file($dosya_yolu)) {
                        unlink($dosya_yolu);
                    }
                }
            }
            echo '<!--- Cache Temiz Bir Başlangıç Yaptı --->';
        } else {
            echo '<!----- Geçmişten Gelen Bir Hatıraya Bakıyorsunuz --->';
        }
    }
}
