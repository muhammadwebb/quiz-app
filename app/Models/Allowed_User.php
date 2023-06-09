<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAllowed_User
 */
class Allowed_User extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'collect_id'
    ];


}
