<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Esto devuelve el id que se ha enviado en la rute, $this->route('usuario')
        // toca revisar con que nombre se está enviado el id en esta, en este caso
        // en la ruta se enviaba como usuario
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->route('usuario')
        ];
    }
}
