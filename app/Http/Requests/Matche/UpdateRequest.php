<?php

namespace App\Http\Requests\Matche;

use App\Models\Matche;
use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
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
            'date' => 'string|max:255',
            'ini_date' => 'string|max:255',
            'end_date' => 'string|max:255',
        ];
    }
}
