<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProperty
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'surface', 'price', 'city'];

}
