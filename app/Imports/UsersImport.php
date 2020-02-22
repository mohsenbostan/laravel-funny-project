<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return User::updateOrCreate(
            [
                'id' => $row['id'],
                'email' => $row['email'],
            ],
            [
                'name' => $row['name'],
                'national_code' => $row['national_code'],
                'password' => Hash::make(substr($row['national_code'], -4)),
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
            ]);
    }
}
