<?php

namespace App\Http\Requests\Perusahaan;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdatePerusahaanRequest extends FormRequest
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
            'nama_perusahaan' => ['required', 'string', Rule::unique('perusahaan', 'nama_perusahaan')->ignore($this->id)],
            'email' => ['required', 'email', Rule::unique('perusahaan', 'email')->ignore($this->id)],
            'alamat' => ['required'],
            'link_website' => ['nullable', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->getMessageBag(), 400));
    }
}
