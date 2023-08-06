<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
