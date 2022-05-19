<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // trong DB dinh nghia khoa chinh roi thi ko can dinh nghia lai o day
    protected $table = 'admins'; // day la bang tren csdl ma model Admin nay se mapping/anh xa toi de lam viec

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
        'gender' => 0
    ]; // them cac gia tri mac dinh

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // khai bao $fillable cho cac thuoc tinh dc dung de su dung dc mass assignment
    protected $fillable = ['username','password', 'email', 'phone', 'fullname', 'address', 'birthday'];

    // bat ki thuoc tinh nao cung dung dc mass assignment, ko bi chi phoi (cach nay it dung hon cach tren)
    // dung 1 trong 2 cach, ko dc phep su dung dong thoi 2 cach
    //protected $guarded = [];

    // n-n, phân quyền
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role', 'admin_id', 'role_id'); // bảng trung gian và 2 khóa ngoại để liên kết trong bảng trung gian(lần lượt là khóa ngoại của bảng hiện tại(admins) và khóa ngoại của bảng muốn join(roles))
    }
}
