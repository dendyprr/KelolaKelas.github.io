<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href=" {{asset('admin/vendor/fontawesome-free/css/all.min.css')}} " rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href=" {{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.partials.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                   @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src=" {{asset('admin/vendor/jquery/jquery.min.js')}} "></script>
    <script src=" {{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <script src=" {{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}} "></script>
    <script src=" {{asset('admin/js/sb-admin-2.min.js')}} "></script>
    <script src=" {{asset('sweetalert/dist/sweetalert2.all.min.js')}}"></script>
    
    <!-- Page level plugins -->
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    <style>
        /* Container animasi disesuaikan agar pas di dalam Card */
        .animation-container {
            position: relative;
            width: 280px;
            height: 180px;
            margin: 0 auto 30px auto;
        }

        .gear-background {
            position: absolute;
            top: 100%;
            left: 10%;
            transform: translate(-50%, -50%);
            width: 230px;
            height: 130px;
            background: rgba(78, 115, 223, 0.1);
            border-radius: 50%;
            animation: pulse 2s infinite ease-in-out;
        }

        .main-icon {
            font-size: 70px;
            color: #4e73df;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: rotateGear 4s linear infinite;
        }

        .dot {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f6c23e;
            border-radius: 50%;
            opacity: 0.7;
        }

        .dot-1 { top: 20px; left: 40px; animation: float 3s infinite ease-in-out; animation-delay: 0.5s; }
        .dot-2 { bottom: 30px; right: 20px; animation: float 3s infinite ease-in-out; animation-delay: 1s; }
        .dot-3 { top: 80px; right: 0px; animation: float 3s infinite ease-in-out; animation-delay: 0s; }

        @keyframes rotateGear {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(0.9); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
    </style>

</body>

</html>