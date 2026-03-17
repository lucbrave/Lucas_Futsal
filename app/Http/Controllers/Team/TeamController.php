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
    /**
     * Lista os times cadastrados com seus jogadores.
     *
     * Retorna um array com `id`, `nome` e, quando existir, a lista de jogadores do time.
     *
     * @return array<int, array<string, mixed>>
     */
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

    /**
     * Cadastra um novo time, respeitando o limite máximo de times.
     *
     * @param  \App\Http\Requests\Team\StoreRequest  $request  Dados validados do time.
     * @return string  Mensagem de sucesso/erro.
     */
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

    /**
     * Atualiza os dados de um time existente.
     *
     * @param  \App\Http\Requests\Team\UpdateRequest  $request  Dados validados para atualização.
     * @param  mixed  $id  Identificador do time.
     * @return string  Mensagem de confirmação.
     */
    public function update(UpdateRequest $request, $id)
    {

        $team = Team::find($id);
        $team->update($request->all());
        return "Time " . $team->id . " atualizado com sucesso";

    }

    /**
     * Exibe os dados de um time e seus jogadores.
     *
     * @param  mixed  $id  Identificador do time.
     * @return array<string, mixed>
     */
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

    /**
     * Remove um time pelo id.
     *
     * @param  mixed  $id  Identificador do time.
     * @return string  Mensagem de confirmação.
     */
    public function delete($id)
    {
        $team = Team::find($id);
        $team->delete();
        return "Time " . $team->id . " removido com sucesso";
    }

    /**
     * Calcula a pontuação de um time (vitória/empate) com base nas partidas.
     *
     * Regras:
     * - Empate: +1 ponto
     * - Vitória: +3 pontos
     *
     * @param  mixed  $id  Identificador do time.
     * @return int  Pontos acumulados.
     */
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

    /**
     * Retorna o ranking (classificação) dos times por pontuação.
     *
     * @return \Illuminate\Support\Collection<int, array<string, mixed>>
     */
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
