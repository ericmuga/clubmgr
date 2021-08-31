<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomUser extends Model
{
    use HasFactory;

    protected $table='zoom_users';
    protected $dates=['created_at',
                         'last_login_time','updated_at'];
    protected $fillable=[ 
                         'user_id',
                         'first_name',
                         'last_name',
                         'email',
                         'type',
                         'pmi',
                         'dept',
                         'created_at',
                         'last_login_time',
                         'pic_url',
                         'phone_number',
                         'status',
                         'role_id'
                        ] ;
}
