<?php

namespace App\Http\Requests\Website\Reservation;

use App\Rules\TourAvailability;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'tour_id' => [
                'required',
                'exists:tours,id',
                new TourAvailability($this->input('start_date'), $this->input('ticket_types', [])),
            ],
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'ticket_types' => 'required|array|min:1',
            'ticket_types.*.ticket_type_id' => 'required|exists:ticket_types,id',
            'ticket_types.*.quantity' => 'required|integer|min:1',
            'extras' => 'array',
            'extras.*' => 'exists:extras,id',
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