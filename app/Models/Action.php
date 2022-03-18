<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static Builder|Action whereUserId($value)
 */
class Action extends Model
{
    use HasFactory;

    protected $hidden = ['id','created_at','updated_at'];
}
