<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 論理削除用に追記
use Illuminate\Database\Eloquent\SoftDeletes;
// ソート用に追記
use Kyslik\ColumnSortable\Sortable;


// リレーションの為に追記
use App\Models\Company;

class Product extends Model {

    // 論理削除用に追記
    use SoftDeletes;

    // ソート用に追記
    use Sortable;
    // ソートに使うカラムを追記
    public $sortable = [ 'id', 'price', 'stock' ];


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
