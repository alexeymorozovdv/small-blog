<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $unique = 'unique:posts,slug';
        if ('admin.post.update' == $this->route()->getName()) {
            $model = $this->route('post');
            $unique = 'unique:posts,slug,'.$model->id.',id';
        }

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'slug' => [
                'required',
                'string',
                'max:100',
                $unique,
                'regex:~^[-_a-z0-9]+$~i',
            ],
            'category_id' => [
                'required',
                'numeric',
                'min:1'
            ],
            'excerpt' => [
                'required',
                'min:100',
                'max:500',
            ],
            'content' => [
                'required',
                'min:500',
            ],
            'image' => [
                'mimes:jpeg,jpg,png',
                'max:5000'
            ],
        ];
    }
}
