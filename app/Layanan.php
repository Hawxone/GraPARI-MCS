<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    public $table = "layanans";
    protected $primaryKey = 'layanan_id';
    protected $fillable = [
        'nama_layanan',
    ];

    public function layanan() {
        return $this->belongsToMany('App/Checklist');
    }
}
