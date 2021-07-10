<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VBRsExport implements FromCollection, WithHeadings
{
    protected $name;
    public $from_date;
    public $to_date;

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $getAllName = $this->$id;
        // if (is_string($this->$id) == 'all') {
        //     return Admin::select(['id','name','email','mobile'])->get();
        // }
       // return Admin::select(['id','name','email','mobile'])->get();

        return Admin::select(['id','name','email','mobile'])
                    ->where('id',$this->id)
                    ->get();
    }

    public function headings(): array
    {
       return [
         '#',
         'Name',
         'Email',
         'Phone',
        ];
     }
}
