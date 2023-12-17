<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $mahasiswaDiterima = Mahasiswa::where('status', 1)->count();
        $mahasiswaDitolak = Mahasiswa::where('status', 2)->count();
        return view('dashboard', compact('jumlahMahasiswa', 'mahasiswaDiterima', 'mahasiswaDitolak'));
    }

    public function resgiter()
    {
        $mahasiswa = Mahasiswa::all();
        $jumlahMahasiswa = Mahasiswa::count();
        return view('registrasi-mahasiswa', compact('mahasiswa', 'jumlahMahasiswa'));
    }

    public function detailMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $jumlahMahasiswa = Mahasiswa::count();
        $kota = City::where('name', $mahasiswa->kabupaten_saat_ini)->first();
        $kecamatan = District::where('name', $mahasiswa->kecamatan_ktp)->first();
        return view('detail-siswa', compact('mahasiswa', 'jumlahMahasiswa', 'kota', 'kecamatan'));
    }

    public function tambah()
    {
        return view('tambah');
    }

    public function store(Request $request)
    {
        $provinsi = Province::where('id', $request->provinsi)->first();
        $kabupaten = City::where('id', $request->kota)->first();
        $kecamatan = District::where('id', $request->kecamatan)->first();

        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_saat_ini' => $request->alamat_saat_ini,
            'kecamatan_ktp' => $kecamatan->name,
            'kabupaten_ktp' => $kabupaten->name,
            'provinsi_ktp' => $provinsi->name,
            'no_tlp' => $request->no_tlp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'kewarganegaraan' => $request->kewarganegaraan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'kabupaten_saat_ini' => $request->kota_kabupaten,
            'provinsi_saat_ini' => $request->provinsi_saat_ini,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_perkawinan' => $request->status_perkawinan,
            'agama' => $request->agama,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('home')
            ->with('success', 'Mahasiswa created successfully.');
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $provinsi = Province::where('id', $request->provinsi)->first();
        $kabupaten = City::where('id', $request->kota)->first();
        $kecamatan = District::where('id', $request->kecamatan)->first();

        $mahasiswa->update([
            'nama' => $request->nama,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_saat_ini' => $request->alamat_saat_ini,
            'kecamatan_ktp' => $kecamatan->name,
            'kabupaten_ktp' => $kabupaten->name,
            'provinsi_ktp' => $provinsi->name,
            'no_tlp' => $request->no_tlp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'kewarganegaraan' => $request->kewarganegaraan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'kabupaten_saat_ini' => $request->kota_kabupaten,
            'provinsi_saat_ini' => $request->provinsi_saat_ini,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_perkawinan' => $request->status_perkawinan,
            'agama' => $request->agama,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('home')
            ->with('success', 'Mahasiswa updated successfully');
    }

    public function diterima($id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $mahasiswa->update([
            'status' => 1,
        ]);
        Alert::success('Success Title', 'Mahasiswa diterima');
        return redirect()->route('registrasi-mahasiswa')
            ->with('success', 'Mahasiswa diterima');
    }

    public function ditolak($id)
    {
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        $mahasiswa->update([
            'status' => 2,
        ]);

        Alert::success('Success Title', 'Mahasiswa ditolak');

        return redirect()->route('registrasi-mahasiswa')
            ->with('success', 'Mahasiswa ditolak');
    }
}
