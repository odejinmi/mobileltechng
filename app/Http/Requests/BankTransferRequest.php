// app/Http/Requests/BankTransferRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankTransferRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bankcode' => 'required|string|size:3',
            'account' => 'required|string|digits:10',
            'account_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:100|max:50000',
            'sessionid' => 'required|string',
            'wallet' => 'required|in:main,ref',
            'narration' => 'required|string|max:255',
            'pin' => 'required|digits:4',
        ];
    }
}