<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAnswer
 */
class Answer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
    ];

    protected $casts = [
        'is_correct'=> 'boolean'
    ];
}
