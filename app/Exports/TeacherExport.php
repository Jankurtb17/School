<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TeacherExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      
        return DB::table('users')
                  ->select('employee_id', 'firstName', 'middleName', 'lastName', 'email')
                  ->where('role_id', 3)
                  ->get();
    }

    public function headings(): array
    {
        return [
            'Employee Id',
            'First Name',
            'Middle Initial',
            'Last Name',
            'Email'
        ];
    }
}
