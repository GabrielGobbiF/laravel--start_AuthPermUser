<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    use HasFactory;

    protected $table = 'plans_details';

    protected $fillable = ['name'];

    public function plan()
    {
        $this->belongsTo(Plan::class);
    }
}
