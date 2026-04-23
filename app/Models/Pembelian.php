<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian'; // Nama tabel eksplisit

    protected $guarded = [];

    /**
     * Logika generate nomor faktur pembelian otomatis
     * Contoh: B-0000001
     */
    public static function getKodeFakturBeli()
    {
        // Query faktur terakhir
        $sql = "SELECT IFNULL(MAX(CAST(SUBSTRING(no_faktur_beli, 3) AS UNSIGNED)), 0) as max_num 
                FROM pembelian ";
        $result = DB::select($sql);

        $maxNum = $result[0]->max_num;
        $noakhir = $maxNum + 1; 
        
        // Bungkus kembali menjadi format B-0000001
        $noakhir = 'B-' . str_pad($noakhir, 7, "0", STR_PAD_LEFT);
        return $noakhir;
    }

    // Relasi ke tabel Vendor (Penyedia barang)
    public function vendor()
    {
        // Pastikan nama kolom di tabel pembelian adalah 'vendor_id'
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // Relasi ke tabel detail barang yang dibeli
    public function pembelianBarang()
    {
        return $this->hasMany(PembelianBarang::class, 'pembelian_id');
    }

    // Opsi: Relasi ke tabel pembayaran (untuk melacak pelunasan ke vendor)
    public function pembayaranPembelian()
    {
        return $this->hasMany(pembayaranPembelian::class, 'pembelian_id');
    }

    
}   