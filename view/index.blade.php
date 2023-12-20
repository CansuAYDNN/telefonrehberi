@extends('layout')
@section('content')
@php
    $sortedRehber = $rehber ?? []; // Eğer $rehber null ise, $sortedRehber'i boş bir dizi ile başlat
    usort($sortedRehber, function($a, $b) {
        return strcmp($a['isim'], $b['isim']);
    });
@endphp

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="description">
                        <h2 style="color: black !important;">Telefon Rehber Uygulaması</h2>
                    </div>
                    <div class="fresh-table full-color-orange">
                        <a href="ekle">
                            <button style="font-size:20px; margin:20px; color:black !important; background-color: transparent !important;" id="alertBtn"
                                class="btn btn-default">Ekle</button>
                        </a>
                        <div class="search-bar" style="float:right; margin:10px;">
                            <form action="" method="GET">
                                <input class="btn btn-default" style="font-size:20px; color:black;" type="text" name="arama_terimi" placeholder="Ara...">
                                <input type="submit" class="btn btn-default" style="font-size:20px; color:black; background-color: transparent;" value="Ara">
                                <a href="index">
                                    <button style="font-size:20px; margin:10px; color:black !important; background-color: transparent !important;" id="backBtn"
                                        class="btn btn-default">Geri Dön</button>
                                </a>
                            </form>
                        </div>
                        <table id="fresh-table" class="table">
                            <thead>
                                <th data-field="resim"></th>
                                <th data-field="isim">İsim</th>
                                <th>Numara</th>
                                <th>Doğum Tarihi</th>
                                <th>Notlar</th>
                            </thead>
                            <tbody>
                                @php
                                // Arama terimini al
                                $searchTerm = isset($_GET['arama_terimi']) ? $_GET['arama_terimi'] : '';

                                // Arama terimine göre filtrele
                                $filteredRehber = array_filter($sortedRehber, function ($item) use ($searchTerm) {
                                    return stripos($item['isim'], $searchTerm) !== false;
                                });

                                // Filtrelenmiş sonuçları ekrana yazdır
                                foreach ($filteredRehber as $item) {
                                    $id = $item["id"];
                                    echo '<tr>';
                                    echo '<td><a href="detay/' . $id . '"><img src="' . $item['resim'] . '" class="img-rounded w-25"></a></td>';
                                    echo '<td class="isim"><a href="detay/' . $id . '">' . $item['isim'] . '</a></td>';
                                    echo '<td class="isim"><a href="detay/' . $id . '">' . $item['numara'] . '</a></td>';
                                    echo '<td class="isim"><a href="detay/' . $id . '">' . $item['dogumtarihi'] . '</a></td>';
                                    echo '<td class="isim"><a href="detay/' . $id . '">' . $item['notlar'] . '</a></td>';
                                    echo '</tr>';
                                }
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
