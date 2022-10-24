<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->all(),$this->method());

        $rule= [
                'title' => ['required', 'min:3', 'unique:posts'],
                'description' => ['required', 'min:10'],
                'post_creator' => ['required', 'exists:users,id'],
        ];

        if ($this->method() =='PUT'){

            $rule = array_merge($rule, ['title' => ['required', 'min:3', 'unique:posts,title,'.$this->route()->post]]);
        }

        // dd($rule);

        return $rule;
    }



public function messages()
{
    return [
            'title.required' => 'This field is required',
            'title.min' => 'Title should be at least 3 characters',
            'description.required' => 'This field is required',
            'description.min' => 'Description should be at least 10 characters',
            'post_creator.required' => 'This field is required', 'post_creator.exists' => 'Invalid value for select options'
    ];
}
}

