<!doctype html>
<html lang="en">

@include('layouts.head')

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="azure" data-image="{{asset('assets/img/sidebar-5.jpg')}}">

            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <center>PMB ITS</center>
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="#">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('registrasi-mahasiswa')}}">
                            <i class="pe-7s-user"></i>
                            <p>Registrasi Mahasiswa</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        @if (Auth::user()->role == 0)
                        <a class="navbar-brand" href="#">Dashboard User</a>

                        @else
                        <a class="navbar-brand" href="#">Dashboard Admin</a>
                        @endif

                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <!-- <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="pe-7s-graph hidden-lg"></i>
                                    <p class="hidden-lg hidden-md active">Dashboard</p>
                                </a>
                            </li>
                            <li>
                                <a href="user.html">
                                    <i class="pe-7s-user hidden-lg"></i>
                                    <p class="hidden-lg hidden-md">Registrasi Mahasiswa</p>
                                </a>
                            </li> -->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card text-center p-2">
                                <img src="assets/img/banner.png" alt="banner" class="img-fluid mx-auto d-block"
                                    style="width: 70%;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (Auth::user()->role == 2)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="header">
                                    <h5 class="title">
                                        <i class="fas fa-database"></i> Total Pendaftar
                                    </h5>
                                    <p class="category">{{$jumlahMahasiswa}}</p>
                                </div>
                                <div class="content">
                                    <a href="{{route('home')}}">
                                        <i class="fas fa-refresh"></i> refresh
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="header">
                                    <h5 class="title">
                                        <i class="fas fa-user-check"></i> Total Pendaftar Yang Diterima
                                    </h5>
                                    <p class="category">{{$mahasiswaDiterima}}</p>
                                </div>
                                <div class="content">
                                    <a href="{{route('home')}}">
                                        <i class="fas fa-refresh"></i> refresh
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="header">
                                    <h5 class="title">
                                        <i class="fas fa-user-alt-slash"></i> Total Pendaftar Yang Ditolak
                                    </h5>
                                    <p class="category">{{$mahasiswaDitolak}}</p>
                                </div>
                                <div class="content">
                                    <a href="{{route('home')}}">
                                        <i class="fas fa-refresh"></i> refresh
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-3">
                            <div class="card">
                                <div class="header">
                                    <h5 class="title">
                                        <i class="fas fa-bookmark"></i> Status Registrasi
                                    </h5>
                                    @php
                                    $mhs = App\Models\Mahasiswa::where('user_id', Auth::user()->id)->first();
                                    @endphp
                                    <p class="category">{{$mhs->status}}</p>
                                </div>
                                <div class="content">
                                    <a href="{{route('home')}}">
                                        <i class="fas fa-refresh"></i> refresh
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="header">
                                    <h5 class="title">
                                        <i class="fas fa-database"></i> Total Pendaftar
                                    </h5>
                                    <p class="category">{{$jumlahMahasiswa}}</p>
                                </div>
                                <div class="content">
                                    <a href="{{route('home')}}">
                                        <i class="fas fa-refresh"></i> refresh
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="dashboard.html">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="https://www.its.ac.id/">
                                    Company
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="dashboard.html">PMB ITS</a>
                    </p>
                </div>
            </footer>

        </div>
    </div>

</body>

@include('layouts.script')

<script type="text/javascript">
    $(document).ready(function() {
        demo.initChartist();
        $.notify({
            message: "Welcome to PMB Institut Tekhnologi Sepuluh Nopember."
        }, {
            type: 'info',
            timer: 4000
        });
    });
</script>

</html>