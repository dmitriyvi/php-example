<?php 
class WorkWeekendDays
{
    protected $daysArr = [
        "monday" => 1,
        "tuesday" => 2,
        "wednesday" => 3,
        "thursday" => 4,
        "friday" => 5,
        "saturday" => 6,
        "sunday" => 7
    ];

    public function get_day_name($dayNum)
    {
        $res = null;
        $lang = app()->getLocale();//активный язык на сайте

        $arr = [
            'ua' => [
                1 => 'пн',
                2 => 'вт',
                3 => 'ср',
                4 => 'чт',
                5 => 'пт',
                6 => 'сб',
                7 => 'нд'
            ],
            'ru' => [
                1 => 'пн',
                2 => 'вт',
                3 => 'ср',
                4 => 'чт',
                5 => 'пт',
                6 => 'сб',
                7 => 'вс'
            ],
            'pl' => [
                1 => 'po',
                2 => 'wt',
                3 => 'śr',
                4 => 'cz',
                5 => 'pi',
                6 => 'so',
                7 => 'ni'
            ],
            'en' => [
                1 => 'Mo',
                2 => 'Tu',
                3 => 'We',
                4 => 'Th',
                5 => 'Fr',
                6 => 'Sa',
                7 => 'Su'
            ]
        ];

        $res = $arr[$lang][$dayNum];//получить название для в зависимости от языка на сайте

        return $res;
    }

    public function groupWorkWeekendDays($days)
    {
        $arr = [];
        $res = [];

        $x = 0;
        $z = 0;

        if(!empty($days)){
            foreach ($days as $dayName => $day) {
                if($day){
                    $arr['work'][$x][] = $this->get_day_name($this->daysArr[$dayName]);
                    $z++;
                }else{
                    $arr['weekends'][$z][] = $this->get_day_name($this->daysArr[$dayName]);
                    $x++;
                }

            }

            if(!empty($arr)){
                foreach ($arr as $key => $arrItem){
                    $works = null;
                    foreach ($arrItem as $item) {
                        if(count($item) > 2){
                            if(empty($works)){
                                $works = $item[0].'-'.end($item);
                            }else{
                                $works = $works.','.$item[0].'-'.end($item);
                            }
                        }else{
                            foreach ($item as $day){
                                if(empty($works)){
                                    $works = $day;
                                }else{
                                    $works = $works.','.$day;
                                }
                            }
                        }
                    }
                    $res[$key] = $works;
                }
            }
        }

        return $res;
    }
}
