<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenukaranBotolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'siswa_id' => [
                'required',
                'exists:siswa,id',
            ],

            'kategori_botol_id' => [
                'required',
                'exists:kategori_botol,id',
            ],

            'jumlah_botol' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }
}