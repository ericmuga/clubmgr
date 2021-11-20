<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
     
    protected $fillable=['code','description'];

    public function members()
    {
        return $this->hasMany(Member::class ,'type_id');
    }
}
