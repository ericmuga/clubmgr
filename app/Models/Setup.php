<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;

    protected $table='setup';
    protected $fillable=['client_id','client_secret','callback_url','environment','current'];




}
