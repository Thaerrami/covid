<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'advice';

    protected $fillable = [
        'question', 'answer',
    ];

    
}
