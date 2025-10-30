<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function users(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx|max:10240',
        ]);

        try {
            $filePath = $request->file('file')->store('temp');
            $import = new UsersImport();

            Excel::import($import, $filePath);

            return redirect()->route('users.index')->with('success', 'Data berhasil diimport');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('users.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
