<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Panel - @yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-switch.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/uploader.css"/>
    <link href="/css/style.css" rel="stylesheet">
</head>

<body class="">
<div class="wrapper ">
    @include('includes.admin-sidebar')
    <div class="main-panel">
    @include('includes.admin-nav')
        <div class="panel-header">
            <div class="header text-center">
                <h2 class="title">@yield('sectionTitle')</h2>
                <p class="category">@yield('sectionDesc')</p>
            </div>
        </div>
        <div class="content">
            @yield('content')

        </div>
        <footer class="footer">
            <div class="container-fluid">
               <div class="copyright">

                    &copy;&nbsp;MDESIGN
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Developed by&nbsp;
                    <a href="http://www.kherbache-mourad.be" target="_blank">Kherbache Mourad</a>.
                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="/js/js.js"></script>
<script src="/js/sweetalert.js"></script>
<script src="/js/datatables.min.js"></script>
<script src="/js/datatables.min.js"></script>
<script src="/js/bootstrap-switch.min.js"></script>
<script src="/js/jquery.ui.widget.js" type="text/javascript"></script>
<script src="/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="/js/admin.js"></script>

</body>

</html>

