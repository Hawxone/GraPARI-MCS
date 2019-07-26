<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    public $table = "perangkats";
    protected $primaryKey = 'perangkat_id';
    protected $fillable = [
        'nama_perangkat',
    ];

    public function perangkat() {
        return $this->belongsToMany('App/Checklist');
    }

}
