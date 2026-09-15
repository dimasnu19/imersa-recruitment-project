<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipVacancy extends Model
{
    /**
     * The attributes that are mass assignable.
     * * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'materi',
        'quota',
        'icon',
        'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     * * @var array<string, string>
     */
    protected $casts = [
        'materi' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the applications for the internship vacancy.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'vacancy_id');
    }
}