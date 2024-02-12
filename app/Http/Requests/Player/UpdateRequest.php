<?php

namespace App\Http\Requests\Player;

use App\Models\Player;
use App\Http\Requests\BaseRequest;



class UpdateRequest extends BaseRequest
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
            'nome'         => 'string|max:255',
            'numero_camisa'     => 'string',
            'team_id'     => 'integer|exists:App\Models\Team,id',

        ];
    }
}
