<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
    public function rules(): array
    {

        return [
            'name' => 'required|min:3|max:255',
            'event_category_id' => 'required|exists:event_categories,id',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/gif,image/svg|mimes:jpeg,png,jpg,gif,svg|max:2048' 
        ];
    }
}
