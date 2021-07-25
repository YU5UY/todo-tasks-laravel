<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTaskRequest extends FormRequest
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
        return [
            //
            "description" => ["required","max:200","min:10"],
        ];
    }
    public function messages(){
        return [
            "description.required" => "Emtpy description",
            "description.min" => "Not enough description",
            "description.max" => "Long description"
        ];
    }
}
