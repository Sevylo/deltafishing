<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'event_id'
    ];
}
