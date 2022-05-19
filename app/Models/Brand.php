<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // trong DB dinh nghia khoa chinh roi thi ko can dinh nghia lai o day
    protected $table = 'brands';

    /**
     * Get the productions for the brands.
     */
    public function productions()
    {
        return $this->hasMany(Production::class, 'brand_id', 'id'); // brand_id là khóa ngoại của bảng productions, 'id' là khóa chính của model hiện tại: Brand(localKey), ngược lại là ownerKey(VD: belongsTo) là khóa chính của model đang đc liên kết - bảng cha
    }
}
