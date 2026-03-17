<?php

namespace App\Http\Controllers\Goal;


use App\Models\Goal;
use App\Models\Matche;
use App\Models\Player;
use App\Http\Controllers\Controller;
use App\Http\Requests\Goal\StoreRequest;

class GoalController extends Controller
{
    /**
     * Lista todos os gols cadastrados.
     *
     * Retorna a coleção completa de registros de `Goal`.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Goal>
     */
    public function index()
    {
        $goals = Goal::all();

        return $goals;
    }


    /**
     * Registra um novo gol e atualiza o placar da partida.
     *
     * - Cria o registro de `Goal` a partir dos dados validados.
     * - Localiza a partida (`Matche`) e o jogador (`Player`) informados.
     * - Incrementa o placar do time correspondente ao time do jogador.
     *
     * @param  \App\Http\Requests\Goal\StoreRequest  $request  Dados validados do gol (inclui `matche` e `player`).
     * @return string  Mensagem de confirmação.
     */
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
