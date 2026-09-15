<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicantExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Application::with(['vacancy', 'user'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Lengkap',
            'Email',
            'No. WhatsApp',
            'Divisi Dilamar',
            'Sistem & Lokasi Penempatan',
            'Asal Institusi',
            'Program Studi',
            'Sumber Informasi',
            'Status Lamaran',
            'Waktu Mendaftar'
        ];
    }

    public function map($application): array
    {
        static $no = 1;
        return [
            $no++,
            $application->full_name,
            $application->email,
            $application->phone,
            $application->vacancy->title ?? 'Divisi Dihapus',
            $application->location ?? 'Belum Memilih',
            $application->institution,
            $application->major,
            $application->source,
            $application->status,
            $application->created_at->format('d M Y H:i') . ' WIB'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Styling untuk baris pertama (Header) menggunakan warna Imersa Deep
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF004B8F']
                ],
            ],
        ];
    }
}