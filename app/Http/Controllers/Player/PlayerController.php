<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Http\Requests\Player\StoreRequest;
use App\Http\Requests\Player\UpdateRequest;

class PLayerController extends Controller
{
    public function index()
    {
        $players = Player::all();
        $playersTeam = [];
        foreach($players as $player) {


            $team_players = [];
            $goals_match = [];
            $goals=0;
            $data = [
                'id'         => (string) $player->id,
                'nome'         => (string) $player->nome,
            ];
            $team_players [] = [
                'nome' => $player->team->nome,
            ];

            $data += [
                'team'         => $team_players,
            ];

            foreach($player->goal as $goal){
                $goals++;
                $goals_match[] = [
                    'id' => $goal->id,
                    'match_id' => $goal->matche,
                ];
            }
            $data += [
                'goals'              =>$goals,
                'goals_match'         => $goals_match,
            ];

            $times[] = $data;


            $playersTeam[] = $data;
        }

        return $playersTeam;
    }
    public function store(StoreRequest $request)
    {

        Player::create($request->all());

        return "Jogador criado com sucesso";
    }



    public function update(UpdateRequest $request, $id)
    {

        $player = Player::find($id);
        $player->update($request->all());
        return "Jogador " . $player->id . " atualizado com sucesso";

    }

    public function show($id)
    {
        $player = Player::find($id);
        return $player;
    }

    public function delete($id)
    {
        $player = Player::find($id);
        $player->delete();
        return "Jogador " . $player->id . " removido com sucesso";
    }
}
