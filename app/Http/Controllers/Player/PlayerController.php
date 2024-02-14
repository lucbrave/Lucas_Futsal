<?php

namespace App\Http\Controllers\Player;

use App\Models\Team;
use App\Models\Player;
use App\Http\Controllers\Controller;
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
        $team=Team::find($request->team_id);

        if (sizeof($team->player)<9){
            Player::create($request->all());
            if (sizeof($team->player)==8){
               return "Ultimo jogador do time registrado com sucesso";
            }else{
               return "Jogador registrado no time sucesso";
            }
        }else{
            return "Todos os 9 jogadores ja foram cadastrados no time";
        }



        return "Jogador adicionado ao time com sucesso";
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
