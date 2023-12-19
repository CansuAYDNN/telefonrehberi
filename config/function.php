<?php
function verifyToken($sessionKey, $tokenToVerify)
{
    // Session'da kayıtlı token ve süresini kontrol edin
    if (!isset($_SESSION[$sessionKey])) {
        exit("Token Gelmedi ! " . "Hata Kodu : #" . md5(time()));
    }
    $tokenData = $_SESSION[$sessionKey];
    // Token süresinin geçip geçmediğini kontrol edin
    if ($tokenData['expires'] < time()) {
        exit("Token Süresi Doldu ! " . "Hata Kodu : #" . md5(time()));
    }
    // Gönderilen token ile session'daki token'ın aynı olup olmadığını kontrol edin
    return hash_equals($tokenData['token'], $tokenToVerify);
}
