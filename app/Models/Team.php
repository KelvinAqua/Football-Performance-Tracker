<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;


    public function players()
    {
        return $this->hasMany(Player::class);
    }

    //Enable Mass Assignment
    protected $fillable = [
        'name',
        'league',
    ];

}

