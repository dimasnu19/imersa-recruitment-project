<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusChanged;

class Application extends Model
{
    protected $guarded = [];

    // Konstanta disesuaikan dengan value dropdown di UI Admin
    const STATUS_APPLIED = 'Applied';
    const STATUS_VALIDATED = 'Validated';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REJECTED = 'Rejected';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(InternshipVacancy::class, 'vacancy_id');
    }

    // Finite State Automaton Logic (Disesuaikan untuk 3 Tahap)
    public function transitionTo(string $newStatus)
    {
        // Cegah eksekusi jika status tidak berubah
        if ($this->status === $newStatus) {
            return;
        }

        $validTransitions = [
            self::STATUS_APPLIED => [self::STATUS_VALIDATED, self::STATUS_REJECTED],
            self::STATUS_VALIDATED => [self::STATUS_ACCEPTED, self::STATUS_REJECTED],
            self::STATUS_ACCEPTED => [], // End state (Tidak bisa diubah lagi)
            self::STATUS_REJECTED => [], // End state (Tidak bisa diubah lagi)
        ];

        // Cek apakah transisi valid
        if (!in_array($newStatus, $validTransitions[$this->status] ?? [])) {
            throw new Exception("Pelanggaran Sistem: Tidak dapat mengubah status dari '{$this->status}' menjadi '{$newStatus}'. Urutan tidak sesuai.");
        }

        $this->update(['status' => $newStatus]);
        
        // Pemicu Otomatis Email Notifikasi
        Mail::to($this->email)->send(new ApplicationStatusChanged($this));
    }
}