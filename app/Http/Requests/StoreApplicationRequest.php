<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'vacancy_id' => ['required', 'exists:internship_vacancies,id'],
            'location' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'internship_period' => ['required', 'string', 'in:3 Bulan,6 Bulan'],
            'institution' => ['required', 'string', 'max:255'],
            'major' => ['required', 'string', 'max:255'],
            'source' => ['required', 'string', 'max:255'],
            'motivation' => ['required', 'string'],
            
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'portfolio' => ['nullable', 'file', 'max:5120'],
            'recommendation_letter' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],

        ];
    }

    public function messages(): array
    {
        return [
            'cv.mimes' => 'Sistem menolak dokumen: CV harus berupa file PDF.',
            'cv.max' => 'Sistem menolak dokumen: Ukuran CV maksimal adalah 2MB.',
            'profile_photo.image' => 'Sistem menolak dokumen: Foto profil harus berupa gambar.',
        ];
    }
}