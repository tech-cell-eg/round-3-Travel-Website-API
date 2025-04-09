<?php

namespace App\Http\Requests\Website\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'comment' => 'required|string',
            'location_rate' => 'required|numeric|between:0,5',
            'amenities_rate' => 'required|numeric|between:0,5',
            'price_rate' => 'required|numeric|between:0,5',
            'room_rate' => 'required|numeric|between:0,5',
            'food_rate' => 'required|numeric|between:0,5',
            'tour_operator' => 'required|numeric|between:0,5',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'user_id' => auth()->id()
        ]);
    }
}
