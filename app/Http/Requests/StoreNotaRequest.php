<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreNotaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $rules = [
      'id_cliente' => 'required',
      ];

      foreach($this->request->get('cantidad') as $key => $val)
      {
        $rules['cantidad.'.$key] = 'required';
    }

    foreach($this->request->get('precio') as $key => $val)
    {
        $rules['precio.'.$key] = 'required';
    }

    return $rules;
}
}
