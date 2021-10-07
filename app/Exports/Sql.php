<?php

class SQL  
{
   public $sql;
   public $_to;
   public $_from;


    /**
     * Class constructor.
     */
    public function __construct($from,$to)
    {
        

      $this->_from=$from;
      $this->_to=$to;
      $this->sql='  use clubmgr;
                    SET @_from="'.$this->_to.'";
                    set @_to="'.$this->_from.'";
                    select 
                    j.participant_id,
                    j.instance_uuid,
                    j.name,
                    j.user_email,
                    j.membership,
                    j.category,
                    j.club_name,
                    j.meeting_date,
                    j.month_name,
                    SUM(j.timeCredit)
                    from (select 
                            a.participant_id,
                            a.instance_uuid,
                            a.name,
                            a.join_time,
                            a.leave_time,
                            a.user_email,
                            b.official_start_time,
                            Date(b.official_start_time) as meeting_date,
                            b.official_end_time,
                            CONCAT(CONVERT(year(b.official_start_time),CHAR(4)),"-",CONVERT(month(b.official_start_time),CHAR(2))) as month_name,
                            CASE WHEN (IFNULL(c.email,"non-member")<>"non-member") then "member" else "non-member" end as membership,
                        d.category,
                        d.club_name,
                        -- (TIME_TO_SEC(end_time) - TIME_TO_SEC(start_time))/60
                        case 
                                -- joined after meeting time
                                
                            when (a.join_time>=b.official_end_time) then 0
                            -- joined before meeting start and left before meeting start
                            when ((a.join_time<b.official_start_time) and (a.leave_time<b.official_start_time)) then 0
                            -- joined before left before
                            when ((a.join_time<=b.official_start_time) and (a.leave_time<=b.official_end_time)) then   (TIME_TO_SEC(a.leave_time) - TIME_TO_SEC(b.official_start_time))/60 -- TIMEDIFF(b.official_start_time,a.leave_time)
                        -- joined after left before
                            when ((a.join_time>=b.official_start_time) and (a.leave_time<=b.official_end_time)) then (TIME_TO_SEC(a.leave_time) - TIME_TO_SEC(a.join_time))/60 -- TIMEDIFF(a.join_time,a.leave_time)
                        -- joined after left after
                            when ((a.join_time>=b.official_start_time) and (a.leave_time>=b.official_end_time)) then (TIME_TO_SEC(b.official_end_time) - TIME_TO_SEC(a.join_time))/60 -- TIMEDIFF(a.join_time,b.official_end_time)
                            -- joined before left after
                            when ((a.join_time<=b.official_start_time) and (a.leave_time>=b.official_end_time)) then (TIME_TO_SEC(b.official_end_time) - TIME_TO_SEC(b.official_start_time))/60 -- TIMEDIFF(b.official_start_time,b.official_end_time)
                            -- joined afer official start time and joined after 
                        
                        end as timeCredit
                        
                        
                        
                    from participants as a 
                    inner join instances as b 
                        on b.uuid=a.instance_uuid and b.official_start_time <> "0000-00-00 00:00:00"
                    left join members as c on c.email=a.user_email
                    inner join registrants as d on a.user_email=d.email
                    where b.official_start_time>=@_from and b.official_end_time<=@_to
                    ) as j

                    group by
                    j.participant_id,
                    j.instance_uuid,
                    j.name,
                    j.user_email,
                    j.membership,
                    j.category,
                    j.club_name,
                    j.meeting_date,
                    j.month_name
                    order by j.meeting_date';
                    
      }
}

?>