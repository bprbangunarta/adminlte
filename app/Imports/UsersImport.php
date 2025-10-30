<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;

class UsersImport implements ToCollection, WithHeadingRow, WithUpserts, SkipsEmptyRows, WithSkipDuplicates, WithBatchInserts, WithChunkReading
{
    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return ['username', 'email'];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::factory()->create([
                'name'     => Str::title($row['nama']),
                'username' => Str::lower($row['username']),
                'email'    => Str::lower($row['email']),
                'password' => '12345',
            ]);

            $user->assignRole($row['peranan']);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
