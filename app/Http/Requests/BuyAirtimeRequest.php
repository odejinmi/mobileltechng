<?php
// app/Http/Requests/BuyAirtimeRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyAirtimeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'operator' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string|max:20',
            'password' => 'required|string',
            'wallet' => 'required|in:main,ref'
        ];
    }
}
