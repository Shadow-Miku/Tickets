<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'accountableid',
        'ticketid'
    ];

    /**
     * Define the relationship between the Assignment model and the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountable()
    {
        return $this->belongsTo(User::class, 'accountableid');
    }

    /**
     * Define the relationship between the Assignment model and the Chat model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
