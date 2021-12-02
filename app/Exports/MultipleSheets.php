<?php

namespace App\Exports;

//use App\Models\Instance;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\InstanceController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;


class AttendancePerMonthSheet implements FromCollection, WithTitle
{
    private $month;
    private $year;
    private $list;

    public function __construct(int $year, int $month,$collection)
    {
        $this->month = $month;
        $this->year  = $year;
        $this->list= $collection;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return $this->collection->where('Month',$this->month)
                                ->where('Year',$this->year);
    }

     public function title(): string
    {
        return 'Month-' . $this->month;
    }
}