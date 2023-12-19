@extends('layout')
@section('content')

    <body>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="description">
                            <h2 style="color: black !important;">Numara Kaydet</h2>
                        </div>
                        <div class="fresh-table full-color-orange">
                            <div class="toolbar">
                                <a style="color:black !important; background-color: transparent !important;" class="btn btn-default" href="index">Geri Dön</a>
                            </div>
                            <form action="hash/numberadd" method="POST" enctype="multipart/form-data">
                                @token('numberadd', 300)
                                <table id="fresh-table" class="table">
                                    <thead>
                                        <th data-field="resim"></th>
                                        <th data-field="isim"></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>İsim</td>
                                            <td class="isim"><input name="isim" class="form-control"
                                                    style="width: 50%;" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Numara</td>
                                            <td class="isim"><input name="numara" class="form-control"
                                                    style="width: 50%;" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Doğum Tarihi</td>
                                            <td class="isim"><input name="dogumtarihi" class="form-control"
                                                    style="width: 50%;" type="text"></td>
                                        </tr>
                                        <td>Not</td>
                                        <td class="isim"><input name="notlar" class="form-control" style="width: 50%"
                                                type="text"></td>
                                        <tr>
                                            <td>Resim</td>
                                            <td class="isim"><input name="resim" class="form-control"
                                                    style="width: 50%;" type="file">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button style="color:black !important; background-color: transparent !important;" name="ekle" type="submit"
                                                    class="btn btn-default">Gönder</button>
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
