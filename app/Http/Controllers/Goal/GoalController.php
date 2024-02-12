<?php

namespace App\Http\Controllers\Goal;


use App\Models\Goal;
use App\Models\Matche;
use App\Models\Player;
use App\Http\Controllers\Controller;
use App\Http\Requests\Goal\StoreRequest;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::all();

        return $goals;
    }


    public function store(StoreRequest $request)
    {
        Goal::create($request->all());

        $Matche = Matche::find($request->matche);

        $player=Player::find($request->player);


        if ($Matche->team_1==$player->team_id){
            $goal_increase=["score_team1" => $Matche->score_team1+1];
            $Matche->update($goal_increase);
        }
        if ($Matche->team_2==$player->team_id){
            $goal_increase=["score_team2" => $Matche->score_team2+1];
            $Matche->update($goal_increase);
        }

        return "Gol confirmado com sucesso";
    }


}
