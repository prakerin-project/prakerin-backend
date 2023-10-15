<?php

namespace App\Http\Requests\Perusahaan;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreatePerusahaanRequest extends FormRequest
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
            'id_jenis_perusahaan' => ['required', 'integer', Rule::exists('jenis_perusahaan', 'id')],
            'nama_perusahaan' => ['required', 'string', 'max:100', Rule::unique('perusahaan', 'nama_perusahaan')],
            'email' => ['required', 'email', Rule::unique('perusahaan', 'email')],
            'alamat' => ['required'],
            'foto' => ['array', 'nullable', 'max:5'],
            'foto.*' => ['mimes:jpeg,jpg,png', 'max:5120']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->getMessageBag(), 400));
    }
}
