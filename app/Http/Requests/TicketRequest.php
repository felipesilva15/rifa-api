<?php

namespace App\Http\Requests;

use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
{
    private $raffle;
    private $ticket;

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
        $id = $this->route('ticket');
        $maximun_number = 9999;

        if ($this->raffle) {
            $maximun_number = $this->raffle->maximum_numbers;
        }

        return [
            'raffle_id' => 'required|integer|exists:raffles,id',
            'participant_id' => 'required|integer|exists:participants,id',
            'number' => [
                'required',
                'integer', 
                Rule::unique('tickets')->where(fn (Builder $query) => $query->where('raffle_id', $this->raffle_id))->ignore($id),
                'min:0',
                'max:'.$maximun_number - 1
            ],
            'payment_date' => 'nullable|date',
            'value' => 'nullable|decimal:0,2|min:0.01'
        ];
    }

    /**
     * Prepare data of request for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $id = $this->route('ticket');
        $this->raffle = Raffle::find($this->raffle_id);
        $this->ticket = Ticket::find($id);

        if ($this->raffle) {
            $this->merge([
                'value' => $this->raffle->ticket_value,
            ]);
        } 

        if (!$id && $this->ticket) {
            $this->merge([
                'value' => $this->ticket->value,
            ]);
        }
    }
}
