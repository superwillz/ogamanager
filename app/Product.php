<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'manufacturer', 'weight', 'colour', 'stock', 'last_updated_by'];

    public function updated_by() {
        return $this->hasOne('App\User', 'id', 'last_updated_by');
    }

    public function category() {
        return $this->hasOne('App\ProductCategory', 'id', 'category_id');
    }
}
