<?php

namespace Modules\Invoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number',
            'facility_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'due_date' => 'required|date',
            'status' => 'required|in:sent,paid',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
