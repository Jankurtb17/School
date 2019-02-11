<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      
        return DB::table('users')
                  ->select('student_id', 'gradeLevel','className', 'firstName', 'middleName', 'lastName', 'email')
                  ->where('role_id', 1)
                  ->get();
    }

    public function headings(): array
    {
        return [
            'Student Id',
            'Grade Level',
            'Section',
            'First Name',
            'Middle Initial',
            'Last Name',
            'Email'
        ];
    }
}
