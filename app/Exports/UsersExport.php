<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all(['id', 'name', 'email', 'national_code', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'National Code',
            'Created at',
            'Updated at'
        ];
    }

}
