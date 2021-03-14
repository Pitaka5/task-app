<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class TaskExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($list) {

        $this->list = $list;
    }

    public function collection()
    {
        return $this->list;
    }
}
