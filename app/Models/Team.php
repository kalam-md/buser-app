<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Team extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_team'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemain()
    {
        return $this->hasMany(Pemain::class);
    }
}
