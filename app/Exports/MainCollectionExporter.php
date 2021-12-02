<?php

namespace App\Exports;

use App\Models\Instance;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\InstanceController;

class MainCollectionExporter implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    * 
    */

      public $list;

   public function __construct($what)
       {
          $this->list=$what;
       }

    public function collection()
    {
        
        return $this->list;
    }
}
