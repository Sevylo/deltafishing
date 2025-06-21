<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $table = 'bayars';
    
    protected $fillable = [
        'nama',
        'alamat',
        'nohp',
        'jumlah',
        'tanggal',
        'nama_barang',
        'harga_satuan',
        'total_harga'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
        'harga_satuan' => 'integer',
        'total_harga' => 'integer'
    ];
}
