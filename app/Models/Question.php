<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperQuestion
 */
class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'collection_id',
        'question',
        'correct_answers',
    ];
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
