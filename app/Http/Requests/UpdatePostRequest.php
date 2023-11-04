<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //今回postreauestとupdaterequest分けてみた。分けなくてもできるが、formのpatchだったりpostだったり
    //送られたものをそれぞれのRequestファイルで処理するようにする
    public function rules(): array
    {
        $rule = [
            'title' => 'required | string | max:50',
            'body' => 'required | string | max:2000',
        ];

        if ($this->file('image')) {
            $rule['image'] = 'required | file | image |mimes:jpg, png';
        }

        return $rule;

    }
}
