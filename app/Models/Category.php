<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\Relation;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function ideas(): Relation
    {
        return $this->hasMany(Ideas::class);
    }
}
