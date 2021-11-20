<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use HasFactory;

      
    protected $fillable=['code','description'];
     
     public function members()
     {
         return $this->hasMany(Member::class,'affiliation_id','id');
     }
}
