<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CariTransaksiRequest extends FormRequest
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
            // 'kategori' => 'required|in:transaksi,pemasukan,pengeluaran',
            'tanggal_awal' => 'required|date|before_or_equal:'.date('d-m-Y'),
            'tanggal_akhir' => 'required|date|before_or_equal:'.date('d-m-Y'),
        ];
    }
}
