@extends('layout')
@section('content')

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="description">
                            <h2 style="color: black !important;">Kişiyi Düzenle</h2>
                        </div>
                        <div class="fresh-table full-color-orange">
                            <div class="toolbar">
                                <a style="color:black !important; background-color: transparent !important;" class="btn btn-default" href="index">Geri Dön</a>
                            </div>
                            <form action="hash/numberupdate" method="POST" enctype="multipart/form-data">
                                <input name="id" class="form-control"
                                                    style="width: 50%;" type="hidden" value="{{ $_GET['bir'] }}">
                                @token('numberupdate', 300)
                                <table id="fresh-table" class="table">
                                    <thead>
                                        <th data-field="resim"></th>
                                        <th data-field="isim"></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>İsim</td>
                                            <td class="isim"><input name="isim" class="form-control"
                                                    style="width: 50%;" type="text" value="{{ $list['isim'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Numara</td>
                                            <td class="isim"><input name="numara" class="form-control"
                                                    style="width: 50%;" type="text" value="{{ $list['numara'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Doğum Tarihi</td>
                                            <td class="isim"><input name="dogumtarihi" class="form-control"
                                                    style="width: 50%;" type="text" value="{{ $list['dogumtarihi'] }}"></td>
                                        </tr>
                                        <td>Not</td>
                                        <td class="isim"><input name="notlar" class="form-control" style="width: 50%"
                                                type="text" value="{{ $list['notlar'] }}"></td>
                                        <tr>
                                        <td>Resim</td>
                                            <td class="isim">
                                                <input name="resim" class="form-control" style="width: 50%;" type="file">
                                                <input name="eski_resim" class="form-control" style="width: 50%;" type="hidden" value="{{ $list['resim']}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button style="background-color: transparent !important;" name="duzenle" type="submit"
                                                    class="btn btn-default">Düzenle</button>
                                            </td>
                                            <td>
                                                <a href="hash/sil/{{$_GET["bir"]}}" style="color:black !important; background-color: transparent !important; float: right;"
                                                    class="btn btn-default">Sil</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(function() {
            $table.bootstrapTable({
                classes: 'table table-hover table-striped',
                toolbar: '.toolbar',
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 8,
                formatShowingRows: function(pageFrom, pageTo, totalRows) {
                    return ''
                },
                formatRecordsPerPage: function(pageNumber) {
                    return pageNumber + ' rows visible'
                }
            })
        })
    </script>
@endsection
