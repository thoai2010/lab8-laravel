<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TitleCase;
use App\Rules\NoForbiddenWords;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
{
    return [
        'title' => ['required', 'string', 'max:255', new NoForbiddenWords],
        'content' => ['required', 'string', new NoForbiddenWords],
        'author' => ['required', 'string', 'max:100'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    ];
}

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'author.required' => 'Vui lòng nhập tên tác giả.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
        ];
    }
}
