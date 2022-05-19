<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaTim extends Model
{
    protected $fillable=['tim_id','nama','tanggal_lahir','id_line','no_wa','ketua'];
    
    public function tim()
    {
        return $this->belongsTo('App\User');
    }
}
