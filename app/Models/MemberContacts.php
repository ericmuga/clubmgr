<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberContacts extends Model
{
    use HasFactory;
    
    protected $fillable=['contact_type','contact','member_id'];


    public function member()
    {
        return $this->belongsTo(Member::class)
    }
}
