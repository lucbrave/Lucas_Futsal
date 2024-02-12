<?php

namespace App\Http\Requests\Matche;

use App\Models\Matche;
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
            'team_1' => 'required|string',
            'team_2' => 'required|string',
        ];
    }
}
