<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SubmitProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nama_product"=>"required",
            "harga"=>"required|numeric|max:1"
        ];
    }
    public function messages()
    {
        return [
            "nama_product.required"=>"Nama Product Harus DI Isi"
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            "status"=>"error",
            "data"=>$errors,
            "message"=>"Validasi Gagal"
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
