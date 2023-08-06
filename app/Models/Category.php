<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

   
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function series(){
        return $this->hasMany(Series::class);
    }

    public function materials(){
        return $this->hasMany(BrandMaterial::class);
    }

    public function colors(){
        return $this->hasMany(Color::class);
    }


    public function sizes(){
        return $this->hasMany(Size::class);
    }


    public function movements(){
        return $this->hasMany(Movement::class);
    }  
}
