<?php

namespace App\Http\Requests\Team;

use App\Models\Team;
use App\Http\Requests\BaseRequest;



class UpdateRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model      = Team::class;
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
        ];
    }
}
