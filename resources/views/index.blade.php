@include('partials.header')

<body id="page-top">

@include('partials.navbar')

<div id="wrapper">

    @include('partials.sidebar')

    <div id="content-wrapper">

        <div class="container-fluid" id="appElChavo">
            <router-view></router-view>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        @include('partials.footer')


    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/js/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin.min.js"></script>
<script src="/dist/elchavo.js"></script>

</body>

</html>
