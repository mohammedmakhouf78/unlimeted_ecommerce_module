<?php

namespace App\Http\Requests\Store;

use App\Models\Store;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
            'name'     => 'required|unique:stores,name,' . $this->store->id,
            'type'     =>  Rule::in(Store::TYPE),
        ];
    }
}
