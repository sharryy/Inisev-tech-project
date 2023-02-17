<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'website_id';

    protected $fillable = [
        'name',
        'url',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'websites_website_id', 'website_id');
    }

    public function subscribers(): HasMany
    {
        return $this->hasMany(Subscription::class, 'websites_website_id', 'website_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'websites_website_id', 'users_user_id');
    }

}
