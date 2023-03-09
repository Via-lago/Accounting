<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTransaksiRequest extends FormRequest
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
            'tanggal_transaksi' => 'required|date|before_or_equal:'.date('d-m-Y'),
            'keterangan' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|integer',
        ];
    }
}
