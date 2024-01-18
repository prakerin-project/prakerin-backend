<?php

namespace App\Http\Requests\pengajuan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePengajuanSiswaRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            /* -------------------------- INSTANCE OF PENGAJUAN ------------------------- */
            'nip_walas'         => ['required', 'string', 'max:20', Rule::unique('pengajuan_siswa', 'nip_walas')],
            'nip_kaprog'        => ['required', 'string', 'max:20', Rule::unique('pengajuan_siswa', 'nip_kaprog')],
            'tanggal_pengajuan' => ['required', 'date'],
            'nama_industri'     => ['required', 'string', 'max:100'],
            'alamat'            => ['required', 'string'],
            //TODO: Add phone number regex
            'kontak_indsutri'   => ['required', 'string'],
            /* ---------------------------- INSTANCE OF SISWA --------------------------- */
            'nis_siswa'         => ['array', 'required']
        ];
    }
}
