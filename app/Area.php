<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function stores(){
        return $this -> hasOne('App\store', 'address1');
    }
    public function users(){
        return $this -> hasOne('App\user', 'address1');
    }
}
