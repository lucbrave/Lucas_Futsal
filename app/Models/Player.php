<?php

namespace App\Models;

use App\Models\Goal;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nome',
        'numero_camisa',
        'team_id'
    ];
    public $allowedIncludes = [
        'team',
        'goal',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault();
    }

    public function goal()
    {
        return $this->hasMany(Goal::class, 'player');
    }
}
