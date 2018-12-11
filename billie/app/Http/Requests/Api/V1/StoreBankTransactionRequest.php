<?php

namespace App\Http\Requests\Api\V1;

use App\BankTransactionEntity;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class StoreBankTransactionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'amount'         => 'required|numeric|min:0',
            'date'           => 'required|date_format:"Y-m-d H:i:s"',
            'parts'          => 'required|array',
            'parts.*.reason' => ['required', Rule::in(BankTransactionEntity::getReasons())],
            'parts.*.amount' => 'required|numeric|min:0',
        ];
    }
}
