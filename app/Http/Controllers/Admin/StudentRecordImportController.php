<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentRecordImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentRecordImportController extends Controller
{
    /**
     * Show the import form
     */
    public function showForm()
    {
        return view('admin.student_record_import.import');
    }

    /**
     * Handle the import
     */
    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // max 10MB
        ]);

        $import = new StudentRecordImport;

        Excel::import($import, $request->file('file'));

        // Collect errors if any
        $failures = $import->failures();
        $errors = $import->errors();

        if ($failures->isNotEmpty()) {
            return back()
                ->with('warning', 'Some rows were skipped due to validation errors.')
                ->with('failures', $failures);
        }

        return back()->with('success', 'Student records imported successfully!');
    }
}
