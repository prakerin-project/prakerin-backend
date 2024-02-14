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
            'nama_industri'     => ['required', 'string', 'max:100'],
            'alamat'            => ['required', 'string'],
            'kontak_indsutri'   => ['required', 'string','regex:^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$'],
            /* ---------------------------- INSTANCE OF SISWA --------------------------- */
            'nis_siswa'         => ['array', 'required']
        ];
    }
}
