<?php

namespace App\Models;

use App\Models\Matche;
use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nome',
    ];

    public $allowedIncludes = [
        'player',
        'matche',
    ];

    public function player()
    {
        return $this->hasMany(Player::class);
    }

    public function matche_team1()
    {
        return $this->hasMany(Matche::class,'team_1');
    }
    public function matche_team2()
    {
        return $this->hasMany(Matche::class,'team_2');
    }
}
