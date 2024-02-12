<?php

namespace App\Http\Requests\Matche;

use App\Models\Matche;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model      = Matche::class;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|string|max:255',
            'ini_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'score_team1' => 'required|string|max:255',
            'score_team2' => 'required|string|max:255',
            'team_2'      => 'required|string',
            'team_1'      => [ 'required',Rule::unique('matches', 'team_1')->where('team_2', $this->input('team_2'))],
        ];
    }

    public function messages()
    {
        return [
            'team_1.unique' => 'Um time só pode jogar contra o outro duas vezes.',
        ];
    }
}
