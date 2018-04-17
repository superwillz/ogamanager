<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['from_id', 'product_id', 'qty'];
    //

    public function ordered_by() {
        return $this->hasOne('App\User', 'id', 'from_id');
    }
}
