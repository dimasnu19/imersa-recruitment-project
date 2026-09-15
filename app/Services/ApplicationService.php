<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Exception;

class ApplicationService
{
    /**
     * Logika untuk menyimpan lamaran baru (Hulu)
     */
    public function storeApplication(array $data, $files)
    {
        // Handle Upload Foto
        $data['profile_photo'] = $files['profile_photo']->store('uploads/photos', 'public');
        
        // Handle Upload CV
        $data['cv'] = $files['cv']->store('uploads/cv', 'public');

        // Handle File Opsional
        if (isset($files['portfolio'])) {
            $data['portfolio'] = $files['portfolio']->store('uploads/portfolios', 'public');
        }
        if (isset($files['recommendation_letter'])) {
            $data['recommendation_letter'] = $files['recommendation_letter']->store('uploads/letters', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status'] = Application::STATUS_APPLIED;

        return Application::create($data);
    }

    /**
     * Logika untuk transisi status (State Machine)
     */
    public function changeStatus(Application $application, string $newStatus)
    {
        // Logika transisi ada di Model Application yang sudah kita buat
        $application->transitionTo($newStatus);
        return $application;
    }
}