<?php

namespace App\Exports;

use App\Models\SiswaModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($siswa, $index) {
            return [
                'No' => $index + 1,
                'NIS' => $siswa->nis,
                'Nama Siswa' => $siswa->nama_siswa,
                'Email' => $siswa->email,
                'Lembaga' => $siswa->lembaga->nama_lembaga,

            ];
        });
    }


    public function headings(): array
    {
        return [
            'No',
            'NIS',
            'Nama Siswa',
            'Email',
            'Lembaga',
        ];
    }
}
