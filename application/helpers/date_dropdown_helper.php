<?

if (!defined('BASEPATH')) exit('No direct script access allowed');

    function buildDayDropdown($name='',$value='')
    {
        $css = 'class="input-small"';
        $days='';
        while ( $days <= '31'){
            $day[]=$days;$days++;
        }
        return form_dropdown($name, $day, $value, $css);
    }

    function buildYearDropdown($name='',$value='')
    {
        $css = 'class="input-small"';
        $years=date('y');
        while ( $years <= '31'+date('y')){
            $year['20'.$years]='20'.$years;$years++;
        }
        return form_dropdown($name, $year, $value, $css);
    }

    function buildBetterYearDropdown($name='',$value='')
    {
        $css = 'class="input-small"';
        $years = range(2000, date("Y"));
        foreach($years as $year)
        {
            $year_list[$year] = $year;
        }

        return form_dropdown($name, $year_list, $value, $css);
    }

    function buildMonthDropdown($name='',$value='')
    {
        $css = 'class="input-small"';
        $month=array(
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December');
        return form_dropdown($name, $month, $value, $css);
    }
?>