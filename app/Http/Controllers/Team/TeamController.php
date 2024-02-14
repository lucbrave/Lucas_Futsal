<?php

namespace App\Http\Controllers\Team;

use App\Models\Goal;
use App\Models\Team;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Http\Requests\Goal\GoalStoreRequest;

class TeamController extends Controller
{
    public function index()
    {
        $times = [];
        $team_players = [];
        $teams = Team::all();
        foreach($teams as $team) {
            $team_players = [];
            $data = [
                'id'         => (string) $team->id,
                'nome'         => (string) $team->nome,
            ];
            foreach($team->player as $player) {
                $team_players [] = [
                    'nome' => $player->nome,
                    'numero_camisa' => $player->numero_camisa,
                ];
            }
            if(!empty($team_players)) {
                $data += [
                    'players'         => $team_players,
                ];
            }
            $times[] = $data;
        }

        return $times;
    }
    public function store(StoreRequest $request)
    {
        $teams = Team::all();
        if (sizeof($teams)<9){
            Team::create($request->all());
            if (sizeof($teams)==9){
               return "Ultimo time criado com sucesso";
            }else{
               return "Time criado com sucesso";
            }

        }else{
            return "Todos os 10 times foram cadastrados";
        }

    }

    public function update(UpdateRequest $request, $id)
    {

        $team = Team::find($id);
        $team->update($request->all());
        return "Time " . $team->id . " atualizado com sucesso";

    }

    public function show($id)
    {
        $team = Team::find($id);

        $data = [
            'id'         => (string) $team->id,
            'nome'         => (string) $team->nome,
        ];
        foreach($team->player as $player) {
            $team_players [] = [
                'nome' => $player->nome,
                'numero_camisa' => $player->numero_camisa,
            ];
        }
        if(!empty($team_players)) {
            $data += [
                'players'         => $team_players,
            ];
        }

        return $data;
    }

    public function delete($id)
    {
        $team = Team::find($id);
        $team->delete();
        return "Time " . $team->id . " removido com sucesso";
    }

    public function points($id)
    {
        $team = Team::find($id);
        $points = 0;
        foreach($team->matche_team1 as $matche) {
            if ($matche->score_team1 == $matche->score_team2) {
                $points = $points + 1;
            }
            if ($matche->score_team1 > $matche->score_team2) {
                $points = $points + 3;
            }
        }
        foreach($team->matche_team2 as $matche) {
            if ($matche->score_team2 == $matche->score_team1) {
                $points = $points + 1;
            }
            if ($matche->score_team2 > $matche->score_team1) {
                $points = $points + 3;
            }
        }
        return $points;
    }

    public function ranking()
    {
        $teams = Team::all();
        $classification = [];
        foreach($teams as $team) {
            $data = [
                'id'         => (string) $team->id,
                'nome'         => (string) $team->nome,
            ];
            $points = 0;
            foreach($team->matche_team1 as $matche) {
                if ($matche->score_team1 == $matche->score_team2) {
                    $points = $points + 1;
                }
                if ($matche->score_team1 > $matche->score_team2) {
                    $points = $points + 3;
                }
            }
            foreach($team->matche_team2 as $matche) {
                if ($matche->score_team2 == $matche->score_team1) {
                    $points = $points + 1;
                }
                if ($matche->score_team2 > $matche->score_team1) {
                    $points = $points + 3;
                }
            }
            $data += [
                'score' => $points,
            ];
            $classification[] = $data;
        }
        return $classification = collect($classification)->sortBy('score')->reverse();
    }


}
