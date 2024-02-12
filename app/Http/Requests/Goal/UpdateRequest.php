<?php

namespace App\Http\Requests\Goal;

use App\Models\Goal;
use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model      = Goal::class;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'player' => 'string|max:255',
            'matche' => 'string|max:255',
            'team' => 'string|max:255',
        ];
    }
}
