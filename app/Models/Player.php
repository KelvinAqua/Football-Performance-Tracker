<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

        public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function matchPerformances()
    {
        return $this->hasMany(MatchPerformance::class)
                    ->orderBy('match_date', 'asc');
    }

    //Enable Mass Assignment
    protected $fillable = [
        'team_id',
        'first_name',
        'last_name',
        'position',
        'nationality',
        'shirt_number',
    ];


}
