<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $dates = ['visit'];
    
    public function user(){
        return $this -> belongsTo('App\User');
    }
    public function product(){
        return $this -> belongsTo('App\Product');
    }
}
