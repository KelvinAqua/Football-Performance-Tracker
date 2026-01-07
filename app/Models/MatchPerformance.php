<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchPerformance extends Model
{
    use HasFactory;

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    //Enable Mass Assignment
    protected $fillable = [
        'player_id',
        'opponent',
        'match_date',
        'minutes_played',
        'goals',
        'assists',
        'rating',
    ];

}
