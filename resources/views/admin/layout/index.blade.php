<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('js/custom.js')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <title>Ojek Trip Indonesia I {{$title}}</title>
    <link rel="icon" href="{{asset('storage/company/Logogram.jpg')}}">
</head>
<body>
    <main>
        <div class="main-container d-flex">
            @include('admin.components.sidebar')
            <div class="container content sidebar-content">
                @include('admin.components.navbar')
                <div class="admin-contents px-3 pt-4">
                    @yield('content')
                </div>
            </div>
        </div>
        <script>
            $(".open-btn").on('click', function(){
            $(".sidebar").addClass('active');
            })
            $(".sidebar ul li").on('click', function(){
                $(".sidebar ul li.active").removeClass('active');
                $(this).addClass('active');
            })
            $(".close-btn").on('click', function(){
                $(".sidebar").removeClass('active');
            })
            $(".admin-contents").on('click', function(){
                $(".sidebar").removeClass('active');
            })
            $(".side-menu").on('click', function(){
                $(".sidebar").removeClass('active');
            })
            $('.logOut').click(function(e) {
                e.preventDefault();            
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, logout!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url : '{{route('adminLogout')}}',
                        success: function (response) {
                            window.location = '/admin'
                        }
                    });
                    } else {
                        location.reload();
                    }
                });
            })
        </script>
    </main>
</body>
@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
</html>