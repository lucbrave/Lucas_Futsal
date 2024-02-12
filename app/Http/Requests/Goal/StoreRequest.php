<?php

namespace App\Http\Requests\Goal;

use App\Models\Goal;
use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
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
            'player' => 'required|string|max:255',
            'matche' => 'required|string|max:255',
            'team' => 'required|string|max:255',
        ];
    }
}
