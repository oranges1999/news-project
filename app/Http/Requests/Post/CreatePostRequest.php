<?php

namespace App\Http\Requests\Post;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !(Auth::user()->role===UserRole::User);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'front_page_image_path'=>'required',
            'title'=>'required|between:3,10',
            'category_id'=>'required',
            'content'=>'required|between:3,10000',
            'publish_at'=>'sometimes',
            'tags'=>'required',
        ];
    }
}
