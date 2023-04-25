<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
