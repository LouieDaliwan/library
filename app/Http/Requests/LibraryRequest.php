<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class LibraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $auth = auth()->user();
        return $auth->hasPermissionTo('can-create-libraries') || $auth->hasPermissionTo('can-edit-libraries');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('libraries')->ignore($this->library->id ?? null), 'string'],
            'type' => ['required', 'string'],
        ];
    }
}
