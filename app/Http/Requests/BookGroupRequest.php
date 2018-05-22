<?php

namespace App\Http\Requests;


use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $exists = auth()->user()->groups()->where('group_id', '=', optional($this->route('group'))->id)
                           ->where('user_id', auth()->id())
                           ->first();

        return !$exists;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => Rule::unique('group_users', 'user_id')
                             ->where(function ($query) {
                                 return $query->where('group_id', request('id'));
                             }),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.unique' => 'You already have a group booked at this time.',
        ];
    }
}
