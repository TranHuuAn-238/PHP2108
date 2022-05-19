<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // trong DB dinh nghia khoa chinh roi thi ko can dinh nghia lai o day
    protected $table = 'productions';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
