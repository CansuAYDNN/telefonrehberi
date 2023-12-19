@extends('layout')
@section('content')

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="description">
                            <h2 style="color: black !important;">Rehber</h2>
                        </div>
                        <div class="fresh-table full-color-orange">
                            <div class="toolbar">
                                <a href="ekle">
                                    <button style="color:black !important; background-color: transparent !important;" id="alertBtn"
                                        class="btn btn-default">Ekle</button>
                                </a>
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
                                    <tr >
                                        @php
                                        $sortedRehber = $rehber; // Kopyasını alarak orijinal diziyi etkilememek için
                                        usort($sortedRehber, function($a, $b) {
                                            return strcmp($a['isim'], $b['isim']);
                                        });
                                    @endphp
                                    @foreach($sortedRehber as $item)
                                        @php
                                            $id = $item["id"];
                                        @endphp
                                    <tr>
                                        <td><a href="detay/{{$id}}"><img src="{{ $item['resim'] }}" class="img-rounded w-25"></a></td>
                                        <td class="isim"><a href="detay/{{$id}}">{{ $item['isim'] }}</a></td>
                                        <td class="isim"><a href="detay/{{$id}}">{{ $item['numara'] }}</a></td>
                                        <td class="isim"><a href="detay/{{$id}}">{{ $item['dogumtarihi'] }}</a></td>
                                        <td class="isim"><a href="detay/{{$id}}">{{ $item['notlar'] }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
   
@endsection
