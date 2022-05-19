<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // trong DB dinh nghia khoa chinh roi thi ko can dinh nghia lai o day
    protected $table = 'permissions';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
        'slug' => '',
        'description' => null
    ]; // them cac gia tri mac dinh khi ko nhap

    protected $fillable = ['name', 'slug', 'description'];

    // bảng permissions cũng quan hệ n-n với bảng roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'role_id', 'permission_id');
    }
}
