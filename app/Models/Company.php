<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// リレーションの為に追記
use App\Models\Product;

class Company extends Model {
    use HasFactory;

    protected $fillable = [
        'company_name',
        'street_adress',
        'representative_name',
    ];

    public function products() {
        return $this->hasMany( Product::class );
    }
}
