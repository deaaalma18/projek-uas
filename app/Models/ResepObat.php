<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan default
    protected $table = 'resep_obat';

    // Tentukan primary key yang benar
    protected $primaryKey = 'id_resep';

    // Pastikan auto-increment jika diperlukan
    public $incrementing = true;

    // Tentukan tipe primary key jika bukan integer
    protected $keyType = 'int';

    // Tentukan timestamps jika tidak menggunakan created_at dan updated_at
    public $timestamps = true;

    // Relasi dengan Dokter (One to Many)
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function kunjunganPasien(){
        return $this->belongsTo(KunjunganPasien::class, 'id_resep', 'id_resep');
    }

    public function detailResep()
{
    return $this->hasMany(DetailResep::class, 'id_resep');
}

public function pasien()
{
    return $this->hasOneThrough(
        Pasien::class,         // Model target (Pasien)
        KunjunganPasien::class, // Model perantara (KunjunganPasien)
        'id_resep',            // Foreign key di KunjunganPasien
        'id_pasien',           // Foreign key di Pasien
        'id_resep',            // Primary key di ResepObat
        'id_pasien'            // Primary key di KunjunganPasien
    );
}


    

}
