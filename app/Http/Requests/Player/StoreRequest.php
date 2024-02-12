<?php

namespace App\Http\Requests\Player;

use App\Models\Player;
use App\Http\Requests\BaseRequest;



class StoreRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model      = Player::class;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'         => 'required|string|max:255',
            'numero_camisa'     => 'required|string',
            'team_id'     => 'required|integer|exists:App\Models\Team,id',

        ];
    }
}
