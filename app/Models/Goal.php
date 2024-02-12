<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Player;
use App\Models\Matche;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;
    protected $table = 'goals';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'team',
        'matche',
        'player',
    ];
    public $allowedIncludes = [
        'player',
        'team',
        'matche',
    ];

    public function player(): BelongsTo
    {
        return $this->BelongsTo(Player::class);
    }
    public function team(): BelongsTo
    {
        return $this->BelongsTo(Team::class);
    }
    public function matche(): BelongsTo
    {
        return $this->BelongsTo(Matche::class);
    }

}
