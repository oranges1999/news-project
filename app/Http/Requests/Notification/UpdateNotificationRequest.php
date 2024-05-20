<?php

namespace App\Http\Requests\Notification;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role === UserRole::Admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|min:3|max:20',
            'msg'=>'required|min:3|max:50',
            'type'=>'required',
            'receiver_id'=>'sometimes',
            'receiver_id.*'=>'int',
            'send_date'=>'required',
        ];
    }
}
