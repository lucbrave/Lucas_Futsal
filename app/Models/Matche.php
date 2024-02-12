<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Matche extends Model
{
    use HasFactory;
    protected $table = 'matches';
    public $timestamps = false;
    protected $fillable = [
        'date',
        'ini_date',
        'end_date',
        'team_1',
        'team_2',
        'score_team1',
        'score_team2',
    ];
    public $allowedIncludes = [
        'players',
        'team',
    ];

    public function team1(): BelongsTo
    {
        return $this->BelongsTo(Team::class, 'team_1');
    }
    public function team2(): BelongsTo
    {
        return $this->BelongsTo(Team::class, 'team_2');
    }

}
