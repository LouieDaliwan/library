<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LibraryBooksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $auth = auth()->user();
        return $auth->hasPermissionTo('can-create-books') || $auth->hasPermissionTo('can-edit-books');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255','min:3'],
            'author' => ['required', 'string', 'max:255','min:3'],
            'isbn' => ['required', Rule::unique('library_books')->ignore($this->book->id ?? null), 'string', 'max:255','min:3'],
            'price' => ['required'],
            'qty' => ['required', 'integer' ],
            'published_at' => ['required']
        ];
    }
}
