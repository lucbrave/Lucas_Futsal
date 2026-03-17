<?php

namespace App\Http\Controllers\Matche;

use App\Models\Team;
use App\Models\Matche;
use App\Http\Controllers\Controller;
use App\Http\Requests\Matche\StoreRequest;
use App\Http\Requests\Matche\UpdateRequest;

class MatcheController extends Controller
{
    /**
     * Lista as partidas cadastradas, incluindo times e jogadores relacionados.
     *
     * Monta uma lista "serializada" com placar e dados dos dois times.
     * Também força o carregamento dos jogadores de cada time via relacionamento.
     *
     * @return array<int, array<string, mixed>>
     */
    public function index()
    {
        $matches = Matche::all();
        $playerdMatches = [];
        foreach($matches as $matche) {
            $team_match = [];
            $data = [
                'id'                  => (string) $matche->id,
                'score_team1'         => (string) $matche->score_team1,
                'score_team2'         => (string) $matche->score_team2,
                'team_1'              => (string) $matche->team_1,
                'team_2'              => (string) $matche->team_2,
            ];
            $team_match [] = [
                'team1' => $matche->team1,
                'team2' => $matche->team2,
            ];

            $matche->team1->player ;
            $matche->team2->player ;

            if(!empty($team_match)) {
                $data += [
                    'teams'         => $team_match,
                ];
            }

            $playerdMatches[] = $data;
        }

        return $playerdMatches;
    }

    /**
     * Cadastra uma nova partida, aplicando regras de validação de negócio.
     *
     * Regras aplicadas:
     * - Um time não pode jogar contra ele mesmo.
     * - Cada time deve possuir pelo menos 7 jogadores para iniciar a partida.
     * - Limita a quantidade total de partidas cadastradas.
     *
     * @param  \App\Http\Requests\Matche\StoreRequest  $request  Dados validados da partida.
     * @return string  Mensagem de sucesso/erro.
     */
    public function store(StoreRequest $request)
    {
        if($request->team_1==$request->team_2){
             return "Um time não pode fazer partida contra ele mesmo";
        }

        $team=Team::find($request->team_1);
        if (sizeof($team->player)<7){
           return $team->nome." precisa de pelo menos 7 jogadores para iniciar a partida";
        }

        $team2=Team::find($request->team_2);
        if (sizeof($team->player)<7){
           return $team2->nome." precisa de pelo menos 7 jogadores para iniciar a partida";
        }

        $matches = Matche::all();
        if (sizeof($matches)<18*5){
            Matche::create($request->all());
            return "Partida criada com sucesso";

        }else{
            return "Ultima partida criada";
        }

    }

    /**
     * Atualiza uma partida existente.
     *
     * @param  \App\Http\Requests\Matche\UpdateRequest  $request  Dados validados para atualização.
     * @param  mixed  $id  Identificador da partida.
     * @return string  Mensagem de confirmação.
     */
    public function update(UpdateRequest $request, $id)
    {

        $Matche = Matche::find($id);
        $Matche->update($request->all());
        return "Partida " . $Matche->id . " atualizada com sucesso";

    }

    /**
     * Exibe os dados de uma partida pelo id.
     *
     * @param  mixed  $id  Identificador da partida.
     * @return \App\Models\Matche|null
     */
    public function show($id)
    {
        $Matche = Matche::find($id);
        return $Matche;
    }

    /**
     * Remove uma partida pelo id.
     *
     * @param  mixed  $id  Identificador da partida.
     * @return string  Mensagem de confirmação.
     */
    public function delete($id)
    {
        $Matche = Matche::find($id);
        $Matche->delete();
        return "Partida " . $Matche->id . " removida com sucesso";
    }


}
