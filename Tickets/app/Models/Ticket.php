<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'clasification',
        'details',
        'status',
        'autorid'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'autorid');
    }

    public function assignment()
    {
        return $this->hasOne(Assignment::class, 'ticketid');
    }
}
