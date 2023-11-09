<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\Relation;
use Cviebrock\EloquentSluggable\Sluggable;

class Idea extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    const PAGINATION_COUNT = 10;

    protected $guarded = [];

    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }

    public function category(): Relation
    {
        return $this->belongsTo(Category::class);
    }

    public function status(): Relation
    {
        return $this->belongsTo(Status::class);
    }

    public function getStatusClasses(): string
    {
        $bgClasses = [
            'Open' => 'bg-gray-200',
            'Closed' => 'bg-red text-white',
            'Considering' => 'bg-purple text-white',
            'In Progress' => 'bg-yellow text-white',
            'Implemented' => 'bg-green text-white'
        ];

        return $bgClasses[$this->status->name];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
