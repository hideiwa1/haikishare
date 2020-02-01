<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $dates = ['limit'];
    
    public function store(){
        return $this -> belongsTo('App\Store');
    }
    public function category(){
        return $this -> belongsTo('App\Category');
    }
    public function sale(){
        return $this -> hasOne('App\Sale') -> where('delete_flg','0');
    }
}
