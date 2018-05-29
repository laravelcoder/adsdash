<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdResponsesRequest extends FormRequest
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
            
            'station_id' => 'required',
            'time' => 'nullable|date_format:H:i:s',
            'impressions' => 'max:2147483647|nullable|numeric',
            'non_impressions' => 'max:2147483647|nullable|numeric',
        ];
    }
}
