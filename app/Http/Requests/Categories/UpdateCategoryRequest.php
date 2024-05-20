<?php

namespace App\Http\Requests\Categories;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::user()->role === UserRole::Admin) {
            return true;
        }
        return redirect()->back()->with('error','You do not have permission');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'category'=>['required','max:255',Rule::unique('categories')->ignore($request->id)],
            'description'=>'required|max:255'
        ];
    }
}
