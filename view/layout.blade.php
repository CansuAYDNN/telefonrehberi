<base href="http://localhost/telefonrehberi/">
<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ $seo['title'] }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>
</head>
@yield('content')
<script type="text/javascript">
    var $table = $('#fresh-table')


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
                return pageNumber + '  Gözüken Kişi Sayısı'
            }
        })
    })
</script>

</html>
