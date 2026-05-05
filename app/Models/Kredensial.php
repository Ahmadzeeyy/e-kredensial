<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kredensial extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'data_lengkap' => 'array',
        'data_asesor' => 'array',
        'data_form5' => 'array',
        'data_form6' => 'array',
        'data_form7' => 'array',
        'data_form9' => 'array',
        'data_form3a' => 'array',
        'data_form3b' => 'array',
        'data_form3d' => 'array',
    ];

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'Submitted' => ['text' => 'Menunggu Review', 'color' => '#6366f1', 'bg' => '#eef2ff'],
            'Under Review' => ['text' => 'Sedang Dicek', 'color' => '#f59e0b', 'bg' => '#fffbeb'],
            'Needs Revision' => ['text' => 'Perlu Revisi', 'color' => '#ef4444', 'bg' => '#fef2f2'],
            'Approved' => ['text' => 'Selesai / Disetujui', 'color' => '#10b981', 'bg' => '#ecfdf5'],
            default => ['text' => $this->status, 'color' => '#64748b', 'bg' => '#f1f5f9'],
        };
    }
}
