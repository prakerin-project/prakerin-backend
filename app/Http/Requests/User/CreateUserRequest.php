<?php

namespace App\Http\Requests\User;

use App\Rules\LowerCaseValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
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
            'username'      => ['required', 'string', 'max:20', 'unique:user,username', new LowerCaseValidation],
            'password'      => ['required', 'string'],
            'nama'          => ['required', 'max:100', 'string'],
            'no_telp'       => ['required', 'max:16'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ];
        //add more rules according to role requested
        switch ($this->role)
        {
            case 'tu':
                $rules = array_merge($rules, ['nip' => ['required', 'max:20', 'unique:tata_usaha,nip']]);
                break;
            case 'hubin':
                $rules = array_merge($rules, ['nip' => ['required', 'max:20', 'unique:hubin,nip']]);
                break;
            case 'walas':
                $rules = array_merge($rules, [
                    'nip' => ['required', 'max:20', 'unique:walas,nip'],
                ]);
                break;
            case 'kaprog':
                $rules = array_merge($rules, [
                    'nip'        => ['required', 'max:20', 'unique:kaprog,nip'],
                    'id_jurusan' => ['required', 'integer', 'unique:kaprog,id_jurusan', "exists:jurusan,id"],
                ]);
                break;
            case 'pembimbing':
                $rules = array_merge($rules, [
                    'nip_nik'    => ['required', 'max:20'],
                    'lingkup'    => ['required', 'in:sekolah,industri'],
                    'id_jurusan' => ['required', 'integer', 'exists:jurusan,id'],
                    'email'      => ['required', 'email', 'unique:pembimbing,email'],
                ]);
                break;
            case 'siswa':
                $rules = array_merge($rules, [
                    'nis'           => ['required', 'max:12', 'unique:siswa,nis'],
                    'id_kelas'      => ['required', 'integer', 'exists:kelas,id'],
                    'email'         => ['required', 'email', 'unique:siswa,email'],
                    'tahun_masuk'   => ['required', 'date_format:Y'],
                    'tempat_lahir'  => ['required', 'max:30'],
                    'tanggal_lahir' => ['required', 'date_format:Y-m-d'],
                    'alamat'        => ['required', 'string'],
                    'no_telp_wali'  => ['required', 'max:16'],
                ]);
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'id_kelas.unique'   => 'One class can only have one Homeroom Teacher',
            'id_jurusan.unique' => 'One major can only have one Head of Major',
            'id_kelas.exists'   => 'Selected jurusan don\'t exist',
            'id_jurusan.exists' => 'Selected kelas don\'t exist',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->getMessageBag(), 400));
    }

}