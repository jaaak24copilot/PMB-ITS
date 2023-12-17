<!doctype html>
<html lang="en">

@include('layouts.head')

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="azure" data-image="{{ asset('assets/img/sidebar-5.jpg') }}">

            <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <center>PMB ITS</center>
                </div>

                <ul class="nav">
                    <li class="non-active">
                        <a href="{{ route('home') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
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
                                    <p class="hidden-lg hidden-md">Dashboard</p>
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
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
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
                    @if (Auth::user()->role == 0)
                        @if ($mahasiswa->first()->find(Auth::user()->id,'user_id') != null)
                            <a href="#"><button type="button" class="btn btn-dark">Sudah Terdaftar</button></a>
                            <br>
                        @else
                            <a href="{{ route('tambah-mahasiswa') }}"><button type="button"
                                    class="btn btn-info btn-fill">Registrasi Mahasiswa</button></a>
                        @endif
                        <br>
                    @else
                    @endif

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Tabel Pendaftar</h4>
                                    @if (Auth::user()->role == 2)
                                        <p class="category">Total : {{ $jumlahMahasiswa }} Siswa</p>
                                    @else
                                    @endif

                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No.</th>
                                            <th>Nama Panjang</th>
                                            <th>Email</th>
                                            <th>No. Telp</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </thead>
                                        @if (Auth::user()->role == 2)
                                            @foreach ($mahasiswa as $mhs)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $mhs->nama }}</td>
                                                        <td>{{ $mhs->email }}</td>
                                                        <td>{{ $mhs->no_hp }}</td>
                                                        <td>{{ $mhs->alamat_saat_ini }}</td>
                                                        <td>
                                                            @switch($mhs->status)
                                                                @case(0)
                                                                    Diproses
                                                                @break

                                                                @case(1)
                                                                    Diterima
                                                                @break

                                                                @case(2)
                                                                    Ditolak
                                                                @break

                                                                @default
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('detail-mahasiswa', $mhs->id) }}"><i
                                                                    class="fas fa-info-circle"></i></a>
                                                            @if ($mhs->status == 0)
                                                                <a href=""
                                                                    onclick="event.preventDefault();
                                document.getElementById('diterima').submit();"><i
                                                                        class="fas fa-check-circle"></i></a>

                                                                <form id="diterima"
                                                                    action="{{ route('diterima-mahasiswa', $mhs->id) }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                </form>
                                                                <a href=""
                                                                    onclick="event.preventDefault();
                                                                document.getElementById('ditolak').submit();"><i
                                                                        class="fas fa-stop-circle"></i></a>
                                                                <form id="ditolak"
                                                                    action="{{ route('diterima-mahasiswa', $mhs->id) }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        @else
                                        @foreach ($mahasiswa as $item)
                                            @if ($item->user_id == Auth::user()->id)
                                                @php
                                                    $mahasiswa = $mahasiswa->where('user_id', Auth::user()->id)->first();
                                                @endphp
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{ $mahasiswa->nama }}</td>
                                                        <td>{{ $mahasiswa->email }}</td>
                                                        <td>{{ $mahasiswa->no_hp }}</td>
                                                        <td>{{ $mahasiswa->alamat_saat_ini }}</td>
                                                        <td>{{ $mahasiswa->status }}</td>
                                                        <td>
                                                            <a href="{{ route('detail-mahasiswa', $mahasiswa->id) }}"><i
                                                                    class="fas fa-info-circle"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endif
                                            @endforeach
                                        @endif
                                    </table>

                                </div>
                            </div>
                        </div>
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

</html>