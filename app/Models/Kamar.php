<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// tambahan
use Illuminate\Support\Facades\DB;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar'; // Nama tabel eksplisit

    protected $guarded = [];

    public static function getKodeKamar()
    {
        // query kode kamar terakhir
        $sql = "SELECT IFNULL(MAX(RIGHT(no_kamar,3)),0) as no_kamar
                FROM kamar";

        $nokamar = DB::select($sql);

foreach ($nokamar as $nk) {
    $kd = $nk->no_kamar;
}

$noawal = $kd + 1;

$noakhir = 'KMR-' . str_pad($noawal,3,"0",STR_PAD_LEFT);

return $noakhir;

        return $noakhir;
    }
}

