<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // required to be able to do mass assignment
    protected $fillable = [
        'user_id',
        'title',
        'company',
        'location',
        'tags',
        'website',
        'email',
        'description'
    ];

     // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    //
    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            // $query->whereAny(
            //     ['tags', 'title', 'description'],
            //     'like',
            //     '%' . request('search') . '%'
            // );
            $query->where('tags', 'like', '%' . request('search') . '%')
                ->orWhere('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }
}
