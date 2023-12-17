<!doctype html>
<html lang="en">

@include('layouts.head')

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">

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
                        <a href="{{ route('registrasi-mahasiswa') }}">
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
                    <button type="button" class="btn btn-info btn-fill" onclick="printForm()">Print Formulir</button>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Data Identitas</h4>
                                </div>
                                <div class="content">
                                    <form action="{{route('update-mahasiswa',$mahasiswa->id)}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nama Lengkap" name="nama" value="{{$mahasiswa->nama}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Alamat KTP</label>
                                                    <input type="text" class="form-control" placeholder="Alamat KTP" name="alamat_ktp" value="{{$mahasiswa->alamat_ktp}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Alamat Lengkap Saat ini</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Alamat Lengkap Saat ini" name="alamat_saat_ini" value="{{$mahasiswa->alamat_saat_ini}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    @inject('provinces', 'App\Http\Controllers\DependantDropdownController')
                                                    @php
                                                        $provinces = $provinces->provinces();
                                                    @endphp
                                                    <select class="form-control" name="provinsi" id="provinsi"
                                                        required>
                                                        <option>==Pilih Salah Satu==</option>
                                                        @foreach ($provinces as $item)
                                                        @if ($mahasiswa->provinsi_ktp == $item->name)
                                                            <option value="{{ $item->id ?? '' }}" selected>
                                                                {{ $item->name ?? '' }}</option>
                                                            
                                                        @else
                                                            <option value="{{ $item->id ?? '' }}">
                                                                {{ $item->name ?? '' }}</option>
                                                                @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kabupaten</label>
                                                    <select class="form-control" name="kota" id="kota" required>
                                                        <option>{{$mahasiswa->kabupaten_ktp}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select class="form-control" name="kecamatan" id="kecamatan" required>
                                                        <option>{{$mahasiswa->kecamatan_ktp}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nomor Telepon</label>
                                                    <input type="tel" class="form-control"
                                                        placeholder="Nomor Telepon" name="no_tlp" value="{{$mahasiswa->no_tlp}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nomor HP</label>
                                                    <input type="tel" class="form-control"
                                                        placeholder="Nomor HP" name="no_hp" value="{{$mahasiswa->no_hp}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{$mahasiswa->email}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kewarganegaraan</label><br>
                                                    @if ($mahasiswa->kewarganegaraan == 'WNI')
                                                        <input type="radio" name="kewarganegaraan" value="WNI" checked>
                                                        WNI<br>
                                                        <input type="radio" name="kewarganegaraan"
                                                            value="WNI keturunan"> WNI keturunan<br>
                                                        <input type="radio" name="kewarganegaraan" value="WNA"> WNA
                                                    @elseif($mahasiswa->kewarganegaraan == 'WNI keturunan')
                                                        <input type="radio" name="kewarganegaraan" value="WNI">
                                                        WNI<br>
                                                        <input type="radio" name="kewarganegaraan"
                                                            value="WNI keturunan" checked> WNI keturunan<br>
                                                        <input type="radio" name="kewarganegaraan" value="WNA"> WNA
                                                    @elseif($mahasiswa->kewarganegaraan == 'WNA')
                                                        <input type="radio" name="kewarganegaraan" value="WNI">
                                                        WNI<br>
                                                        <input type="radio" name="kewarganegaraan"
                                                            value="WNI keturunan"> WNI keturunan<br>
                                                        <input type="radio" name="kewarganegaraan" value="WNA" checked>
                                                        WNA

                                                    @else
                                                       <input type="radio" name="kewarganegaraan" value="WNI">
                                                    WNI<br>
                                                    <input type="radio" name="kewarganegaraan"
                                                        value="WNI keturunan"> WNI keturunan<br>
                                                    <input type="radio" name="kewarganegaraan" value="WNA"> WNA 
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tanggal Lahir (Sesuai Ijazah)</label>
                                                    <input type="date" class="form-control"
                                                        placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{$mahasiswa->tanggal_lahir}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tempat Lahir (Sesuai Ijazah)</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Tempat Lahir" name="tempat_lahir" value="{{$mahasiswa->tempat_lahir}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kota/Kabupaten</label>
                                                    <select class="form-control" name="kota_kabupaten">
                                                        @if ($mahasiswa->kota_kabupaten == 'Kota')
                                                            <option value="Kota" selected>Kota</option>
                                                            <option value="Kabupaten">Kabupaten</option>
                                                        @else
                                                            <option value="Kota" >Kota</option>
                                                            <option value="Kabupaten" selected>Kabupaten</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Propinsi</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Propinsi" name="provinsi_saat_ini" value="{{$mahasiswa->provinsi_saat_ini}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-control" name="jenis_kelamin">
                                                        @if ($mahasiswa->jenis_kelamin == "laki-laki")
                                                        <option value="laki-laki" selected>Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                        @else
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value selected="perempuan">Perempuan</option>
                                                        @endif
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Status Menikah</label><br>
                                                    @if ($mahasiswa->status_perkawinan == "Belum menikah")
                                                        <input type="radio" name="status_perkawinan"
                                                        value="Belum menikah" checked> Belum menikah<br>
                                                        <input type="radio" name="status_perkawinan" value="Menikah">
                                                        Menikah<br>
                                                        <input type="radio" name="status_perkawinan" value="Cerai">
                                                        Cerai
                                                    @elseif ($mahasiswa->status_perkawinan == "Menikah")
                                                    <input type="radio" name="status_perkawinan"
                                                    value="Belum menikah" > Belum menikah<br>
                                                    <input type="radio" name="status_perkawinan" value="Menikah" checked>
                                                    Menikah<br>
                                                    <input type="radio" name="status_perkawinan" value="Cerai">
                                                    Cerai
                                                    @else
                                                    <input type="radio" name="status_perkawinan"
                                                    value="Belum menikah" > Belum menikah<br>
                                                    <input type="radio" name="status_perkawinan" value="Menikah" >
                                                    Menikah<br>
                                                    <input type="radio" name="status_perkawinan" value="Cerai" checked>
                                                    Cerai
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Agama</label><br>
                                                    @if ($mahasiswa->agama == "Islam")
                                                    <input type="radio" name="agama" value="Islam" checked> Islam<br>
                                                    <input type="radio" name="agama" value="Kristen"> Kristen<br>
                                                    <input type="radio" name="agama" value="Katolik"> Katolik<br>
                                                    <input type="radio" name="agama" value="Hindu"> Hindu<br>
                                                    <input type="radio" name="agama" value="Budha"> Budha<br>
                                                    @elseif ($mahasiswa->agama == "Kristen")
                                                    <input type="radio" name="agama" value="Islam"> Islam<br>
                                                    <input type="radio" name="agama" value="Kristen" checked> Kristen<br>
                                                    <input type="radio" name="agama" value="Katolik"> Katolik<br>
                                                    <input type="radio" name="agama" value="Hindu"> Hindu<br>
                                                    <input type="radio" name="agama" value="Budha"> Budha<br>
                                                    @elseif ($mahasiswa->agama == "Katolik")
                                                    <input type="radio" name="agama" value="Islam"> Islam<br>
                                                    <input type="radio" name="agama" value="Kristen"> Kristen<br>
                                                    <input type="radio" name="agama" value="Katolik" checked> Katolik<br>
                                                    <input type="radio" name="agama" value="Hindu"> Hindu<br>
                                                    <input type="radio" name="agama" value="Budha"> Budha<br>
                                                    @elseif ($mahasiswa->agama == "Hindu")
                                                    <input type="radio" name="agama" value="Islam"> Islam<br>
                                                    <input type="radio" name="agama" value="Kristen"> Kristen<br>
                                                    <input type="radio" name="agama" value="Katolik"> Katolik<br>
                                                    <input type="radio" name="agama" value="Hindu" checked> Hindu<br>
                                                    <input type="radio" name="agama" value="Budha"> Budha<br>
                                                    @elseif ($mahasiswa->agama == "Budha")
                                                    <input type="radio" name="agama" value="Islam"> Islam<br>
                                                    <input type="radio" name="agama" value="Kristen"> Kristen<br>
                                                    <input type="radio" name="agama" value="Katolik"> Katolik<br>
                                                    <input type="radio" name="agama" value="Hindu"> Hindu<br>
                                                    <input type="radio" name="agama" value="Budha" checked> Budha<br>
                                                        
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->role == 0)
                                            <button type="submit"
                                                class="btn btn-info btn-fill center-block ">Update
                                                Informasi</button>
                                        @endif
                                        
                                    </form>
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
                        </script> <a href="{{ route('home') }}">PMB ITS</a>
                    </p>
                </div>
            </footer>

        </div>
    </div>

</body>

<!--  Charts Plugin -->
<script src="{{asset('assets/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script>
    function printForm() {
        window.print();
    }
</script>

<script>
    function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#' + name).empty();
                $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                $.each(data, function(key, value) {
                    $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }
    $(function() {
        $('#provinsi').on('change', function() {
            onChangeSelect('/cities', $(this).val(), 'kota');
        });
        $('#kota').on('change', function() {
            onChangeSelect('/districts', $(this).val(), 'kecamatan');
        })
        $('#kecamatan').on('change', function() {
            onChangeSelect('/villages', $(this).val(), 'desa');
        })
    });
</script>

</html>