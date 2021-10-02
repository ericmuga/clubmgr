<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingRule extends Model
{
    use HasFactory;
    protected $table='grading_rules';
    protected $fillable= ['rule_name','description','meeting_type','threshhold'];

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }


}
