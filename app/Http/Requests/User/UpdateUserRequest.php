<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\LowerCaseValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
        $rules = [
            'username'      => ['sometimes', 'string', 'max:20', new LowerCaseValidation],
            'nama'          => ['sometimes', 'max:100', 'string'],
            'no_telp'       => ['sometimes', 'max:16'],
            'jenis_kelamin' => ['sometimes', 'in:L,P'],
        ];
        //add more rules according to role requested
        switch ($this->role)
        {
            case 'tu':
                $rules = array_merge($rules, ['nip' => ['sometimes', 'max:20']]);
                break;
            case 'hubin':
                $rules = array_merge($rules, ['nip' => ['sometimes', 'max:20']]);
                break;
            case 'walas':
                $rules = array_merge($rules, [
                    'nip' => ['sometimes', 'max:20'],
                ]);
                break;
            case 'kaprog':
                $rules = array_merge($rules, [
                    'nip'        => ['sometimes', 'max:20'],
                    'id_jurusan' => ['integer', 'sometimes'],
                ]);
                break;
            case 'pb_sekolah':
            case 'pb_industri':
                $rules = array_merge($rules, [
                    'nip_nik'    => ['sometimes', 'max:20'],
                    'lingkup'    => ['sometimes', 'in:sekolah,industri'],
                    'id_jurusan' => ['sometimes', 'integer', 'sometimes'],
                    'email'      => ['sometimes', 'email'],
                ]);
                break;
            case 'siswa':
                $rules = array_merge($rules, [
                    'nis'           => ['sometimes', 'max:12'],
                    'id_kelas'      => ['integer', 'sometimes'],
                    'email'         => ['sometimes', 'email'],
                    'tahun_masuk'   => ['sometimes', 'date_format:Y'],
                    'tempat_lahir'  => ['sometimes', 'max:30'],
                    'tanggal_lahir' => ['sometimes', 'date_format:Y-m-d'],
                    'alamat'        => ['sometimes', 'string'],
                    'no_telp_wali'  => ['sometimes', 'max:16'],
                ]);
                break;
        }
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->getMessageBag(), 400));
    }
}