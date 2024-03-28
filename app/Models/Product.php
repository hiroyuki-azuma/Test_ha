<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// リレーションの為に追記
use App\Models\Company;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'img_path',
        'price',
        'stock',
        'comment',
    ];

    public function company() {
        return $this->belongsTo( Company::class );
    }

    public function sales() {
        return $this->hasMany( Sale::class );
    }

}
