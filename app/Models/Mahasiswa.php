<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nama',
        'alamat_ktp',
        'alamat_saat_ini',
        'kecamatan_ktp',
        'kabupaten_ktp',
        'provinsi_ktp',
        'no_tlp',
        'no_hp',
        'email',
        'kewarganegaraan',
        'tanggal_lahir',
        'tempat_lahir',
        'kabupaten_saat_ini',
        'provinsi_saat_ini',
        'jenis_kelamin',
        'status_perkawinan',
        'agama',
        'status',
        'user_id'
    ];
}
