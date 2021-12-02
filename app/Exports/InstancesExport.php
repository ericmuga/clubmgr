<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\InstancesPerMonthSheet;

class InstancesExport implements WithMultipleSheets
{
    use Exportable;

   
    protected $collection;
    protected $year_month;
    protected $uniqeIdColumn;
    protected $spreadColumn;
    
    public function __construct($collection,$year_month,$uniqeIdColumn,$spreadColumn)
    {
        $this->collection=$collection;
        $this->year_month=$year_month;
        $this->uniqeIdColumn=$uniqeIdColumn;
        $this->spreadColumn=$spreadColumn;
       
      
        
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

          foreach($this->year_month as $year_month) 
             $sheets[] = new InstancesPerMonthSheet($year_month,$this->collection,$this->uniqeIdColumn,$this->spreadColumn);
       

        return $sheets;
    }
}

?>