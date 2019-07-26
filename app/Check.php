<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    public $table = "checks";
    protected $primaryKey = 'check_id';
    protected $fillable = [
        'nama_checklist','status'
    ];
}
