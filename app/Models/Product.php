<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function banner()
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }

    
    public function productItem(){
        return $this->hasMany(ProductItem::class);
    }

    public function productCase()
    {
        return $this->hasMany(ProductCase::class);
    }


    public function productDial()
    {
        return $this->hasMany(ProductDial::class);
    }

    public function productBand()
    {
        return $this->hasMany(ProductBand::class);
    }

    public function productMovement()
    {
        return $this->hasMany(ProductMovement::class);
    }


    public function productAddition()
    {
        return $this->hasMany(ProductAdditional::class);
    }


    public function brand_material()
    {
        return $this->belongsTo(BrandMaterial::class, 'material_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function movement()
    {
        return $this->belongsTo(Movement::class, 'movement_id', 'id');
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id', 'id');
    }




   

}
