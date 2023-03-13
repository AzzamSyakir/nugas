<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $fillable = ['nama_barang', 'harga', 'user_id'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
