<?php

namespace App\Models;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'shortabs'
    ];
}
