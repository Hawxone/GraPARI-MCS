<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    public $table = "apps";
    protected $primaryKey = 'app_id';
    protected $fillable = [
        'nama_app',
    ];

    public function app() {
        return $this->belongsToMany('App/Checklist');
    }
}
