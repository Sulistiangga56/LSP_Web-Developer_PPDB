<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    protected $table = 'data_user';

    protected $primaryKey = 'Id_pendaftar';

    protected $fillable = [
        'Nm_pendaftar',
        'Alamat',
        'Jenis_kelamin',
        'No_hp',
        'Asal_sekolah',
        'Jurusan',
        'Tgl_lahir',
        'NISN',
    ];
}
