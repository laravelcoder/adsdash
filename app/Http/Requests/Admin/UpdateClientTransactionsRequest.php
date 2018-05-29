<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientTransactionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'transaction_type_id' => 'required',
            'income_source_id' => 'required',
            'currency_id' => 'required',
            'transaction_date' => 'required|date_format:'.config('app.date_format'),
        ];
    }
}
