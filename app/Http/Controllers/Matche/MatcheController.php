<?php

namespace App\Http\Controllers\Matche;

use App\Models\Matche;
use App\Http\Controllers\Controller;
use App\Http\Requests\Matche\StoreRequest;
use App\Http\Requests\Matche\UpdateRequest;

class MatcheController extends Controller
{
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
    public function store(StoreRequest $request)
    {
        dd($request);
        if($request->team_1==$request->team_2){
             return "Um time não pode fazer partida contra ele mesmo";
        }

        Matche::create($request->all());

        return "Partida criada com sucesso";
    }



    public function update(UpdateRequest $request, $id)
    {

        $Matche = Matche::find($id);
        $Matche->update($request->all());
        return "Partida " . $Matche->id . " atualizada com sucesso";

    }

    public function show($id)
    {
        $Matche = Matche::find($id);
        return $Matche;
    }

    public function delete($id)
    {
        $Matche = Matche::find($id);
        $Matche->delete();
        return "Partida " . $Matche->id . " removida com sucesso";
    }


}
