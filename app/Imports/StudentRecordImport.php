<?php

namespace App\Imports;

use App\Models\StudentRecord;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentRecordImport implements SkipsOnError, SkipsOnFailure, ToModel, WithHeadingRow, WithValidation
{
    use SkipsErrors, SkipsFailures;

    /**
     * Map each row to a StudentRecord model
     */
    public function model(array $row)
    {
        return new StudentRecord([
            'district_id' => $row['district_id'],         
            'batch_id' => $row['batch_id'],
            'name' => $row['name'],
            'father_name' => $row['father_name'],
            'mother_name' => $row['mother_name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'academic_qualification' => $row['academic_qualification'],
            'address' => $row['address'],
            'freelancer_profile_url' => $row['freelancer_profile_url'],
            'profile_photo' => $row['profile_photo'],
            'income_source' => $row['income_source'],
            'gender' => $row['gender'],
        ]);
    }

    /**
     * Validation rules for each row
     */
    public function rules(): array
    {
        return [];
        // return [
        //     'district_id' => 'required|integer|exists:districts,id',
        //     'upazila_id' => 'required|integer|exists:upazilas,id',
        //     'batch_id' => 'required|integer|exists:batches,id',
        //     'name' => 'required|string|max:255',
        //     'father_name' => 'required|string|max:255',
        //     'mother_name' => 'required|string|max:255',
        //     'phone' => 'required|string|max:20',
        //     'email' => 'required|email|max:255',
        //     'academic_qualification' => 'nullable|string|max:255',
        //     'address' => 'nullable|string|max:500',
        //     'freelancer_profile_url' => 'nullable|url|max:255',
        //     'profile_photo' => 'nullable|string|max:255',
        //     'income_source' => 'nullable|string|max:255',
        //     'gender' => 'required|in:male,female,other',
        // ];
    }
}
