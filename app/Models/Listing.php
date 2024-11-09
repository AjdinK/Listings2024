<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'email', 'tags', 'link', 'image', 'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.request('search').'%')
                    ->orWhere('description', 'like', '%'.request('search').'%');
            });
        }

        if ($filters['user_id'] ?? false) {
            $query->where('user_id', request('user_id'));
        }

        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%'.request('tag').'%');
        }

        if ($filters['disapproved'] ?? false) {
            $query->where('approved', false);
        }

    }
}
