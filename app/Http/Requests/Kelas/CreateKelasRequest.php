<?php

namespace App\Http\Requests\Kelas;

use App\Models\Kelas;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateKelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /* TODO: Change authorize just for user with role: hubin */
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
            'nip_walas'  => ['required', 'string', Rule::exists('walas', 'nip')],
            'id_jurusan' => ['required', 'integer', Rule::exists('jurusan', 'id')],
            'kelompok'   => ['nullable', 'max:1', 'string'],
            'tingkat'    => ['required', Rule::in(['10', '11', '12'])],
            'angkatan'   => ['required', 'integer'],
        ];
    }

    public function after()
    {
        return [
            // Unique one of Kelas columns
            function (Validator $validator) {
                if (
                    Kelas::query()
                        ->where('nip_walas', $this->nip_walas)
                        ->where('id_jurusan', $this->id_jurusan)
                        ->where('kelompok', $this->kelompok)
                        ->where('tingkat', $this->tingkat)
                        ->where('angkatan', $this->angkatan)
                        ->get()->count() > 0
                )
                {
                    $validator->errors()->add('kelas', "Kelas already exist.");
                }
            }
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->getMessageBag(), 400));
    }
}