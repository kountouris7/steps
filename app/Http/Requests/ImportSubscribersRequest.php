<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportSubscribersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $month_id = request('month_id');

        return [

            'name'         => 'nullable|max:30',
            'surname'      => 'nullable|max:30',
            'email'        => 'unique',
            'package_week' => 'nullable',
            'amount'       => 'nullable',
            'discount'     => 'nullable',
            'price'        => 'nullable',
            'file'         => 'required',

        ];
    }
}
