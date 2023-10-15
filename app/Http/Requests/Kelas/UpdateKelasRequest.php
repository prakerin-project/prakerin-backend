<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateKelasRequest extends FormRequest
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
            'id_jurusan' => ['required', 'integer', Rule::exists('jurusan', 'id')],
            'kelompok' => ['nullable', 'max:1', 'string'],
            'tingkat' => ['required', Rule::in(['10', '11', '12'])],
            'angkatan' => ['required', 'integer']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->getMessageBag(), 400));
    }
}
