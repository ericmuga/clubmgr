<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;

class InstanceParticipantsExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
      use Exportable;
    public $uuid;        

    public function __construct($uuid)
    {
      $this->uuid=$uuid;
    }

   

    public function array(): array
    {
        return [
                    ['name', 'email'],
                    ['John Doe','email@example.com']
                ];
    }
}
