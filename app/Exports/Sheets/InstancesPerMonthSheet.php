<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Participant;
use App\Models\Member;

class InstancesPerMonthSheet implements FromCollection, WithTitle
{
    private $year_month;
    private $collection;
    protected $uniqeIdColumn;
    protected $spreadColumn;

    public function __construct($year_month,$collection,$uniqeIdColumn,$spreadColumn)
    {
        //dd($spreadColumn);
         $this->year_month  = $year_month;
        $this->collection=$collection;
        $this->uniqeIdColumn=$uniqeIdColumn;

        $this->spreadColumn=$spreadColumn;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        $collection=$this->collection->where('instance_year_month', $this->year_month);
        $spreadColumn=$this->spreadColumn;
        $uniqeIdColumn=$this->uniqeIdColumn;

       //dd($collection);

       $spreadColunms=collect([]);
        foreach ($collection->groupBy($spreadColumn) as $key=>$value) 
        {
            $spreadColunms->push($key);
        }
        

        $finalCollection=collect([]);
        // dd($collection->groupBy($uniqeIdColumn));
          foreach($collection->groupBy($uniqeIdColumn)as $key=>$value)
            {
                 
                 $memberColletion['name']=$collection->where('member_id',$key)->first()['name'];
                 $memberColletion['email']=$collection->where('member_id',$key)->first()['email'];
                 $affiliation='Guest'; $club_name='';$membership='non-member';
                 if(Participant::where('user_email',$memberColletion['email'])->exists())
                    {
                        $participant=Participant::where('user_email',$memberColletion['email'])->first();
                        if($participant->registrant()->exists())
                        {
                            $registrant=$participant->registrant()->first();
                            switch ($registrant->category) 
                            {
                                case 'Rotarian':$affiliation='Rotarian'; break;
                                case 'RTN':$affiliation='Rotarian'; break;
                                case 'Rotaractor':$affiliation='Rotaractor'; break;
                                case 'RCT':$affiliation='Rotaractor'; break;
                                case 'RCT':$affiliation='Rotaractor'; break;
                                default:$affiliation='Guest'; break;
                            }

                            $club_name=$registrant->club_name;
                           

                        }
                    }

                  $memberColletion['Category']=$affiliation;
                  $memberColletion['Clubname']=$club_name;
                  $memberColletion['Membership ']=(Member::firstWhere('id',$key)->member_id!='')?'member':'non-member';

                 $total=0;


               
                                                              
                 for ($i=0; $i < $spreadColunms->count() ; $i++) 
                 { 
         

                    $memberColletion[$spreadColunms[$i]]=($collection->where('member_id',$key)
                                                                         ->where('instance_date',$spreadColunms[$i])
                                                                         ->first())?
                                                                      $collection->where('member_id',$key)
                                                                                 ->where('instance_date',$spreadColunms[$i])
                                                                                 ->first()['score']:0;

                     

                     $total+=$memberColletion[$spreadColunms[$i]];     
                                                                        
                 }
                 $memberColletion['total']=$total;              
                 $memberColletion['Percentage']=round($total/$spreadColunms->count()*100,2);
                 

              $finalCollection->push($memberColletion); 
              $memberColletion=[];   
             
        }


             //make headers
        $headers=[];

         for ($i=0; $i < $spreadColunms->count() ; $i++) 
                 { 
         

                    $headers['name']='NAME';
                    $headers['email']='EMAIL';
                    $headers['CATEGORY']='CATEGORY';
                    $headers['Club']='Club';
                    $headers['MEMBERSHIP']='MEMBERSHIP';
                    // $headers['Month']='Month';
                    // $headers['Year']='Year';
                    $headers[$spreadColunms[$i]]=$spreadColunms[$i];
                    
                     
                 }
                 $headers['TOTAL']='TOTAL';
                 $headers['Attended']='% Attended';
            
             $finalCollection->prepend($headers);
 


        //end of pivoting

        return $finalCollection;
                                

    /**
     * @return string
     */
     }
    

    public function title(): string
    {
        return  $this->year_month;
    }
}