<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentTemplateExport implements FromCollection, WithHeadings
{
    protected $class_id;

    public function __construct($class_id)
    {
        $this->class_id = $class_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $collection = collect([
            [
                'class_id' => $this->class_id,
                'name' => null,
                'phone' => null,
                'father_name' => null,
                'father_phone' => null,
                'mother_name' => null,
                'mother_phone' => null,
                'school_name' => null,
            ],
        ]);

        return $collection;
    }

    public function headings(): array
    {
        return [
            'class_id',
            'name',
            'phone',
            'father_name',
            'father_phone',
            'mother_name',
            'mother_phone',
            'school_name',
        ];
    }
}
