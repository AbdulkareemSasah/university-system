<?php

namespace App\Http\Controllers;


use App\Models\General;
use App\Models\Level;
use App\Models\Table;
use Elibyy\TCPDF\Facades\TCPDF as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    function index(int $id)
    {
        $table  = Table::find($id);
        $year = $table->year()->get("name")->toArray()[0]["name"];
        $collage  = $table->collage()->get()->toArray();
        $departments  = $table->collage->departments->toArray();
        $departments_text = implode(' - ', array_map(function ($k, $v) {
            return $v["name"]["ar"];
        }, array_keys($departments), array_values($departments)));
        $term = $table->term()->get("name")->toArray()[0]["name"]["ar"];
        $lectures = getLecturesGroupedByTimeDay($id);
        $general  =  General::first();
        $footer  =  $general->get("footer")->toArray()[0]["footer"]["ar"];
        $name_university  =  $general->get("university_name")->toArray()[0]["university_name"]["ar"];
        $navbar  =  $general->get("navbar")->toArray()[0]["navbar"]["ar"];
        $logo  =  $general->get("logo")->toArray()[0]["logo"];
        $footer_text = implode("<td></td>", array_map(function ($k, $v) {
            return '<td style="text-align: right;font-size: 13px">' . $v["data"]["position"] . '<br>' . $v["data"]["title_name"] . '<br>' . $v["data"]["name"] . '</td>';
        }, array_keys($footer), array_values($footer)));
        $header = '<table width="100%">
    <tr>
        <td style="text-align: right;">' . $navbar[0]["data"]["country"] . '<br>' . $navbar[0]["data"]["ministry"] . '<br>' . $name_university . '<br>' . 'كلية ' . $collage[0]["name"]["ar"] . '</td>

        <td style="text-align: center;font-size: 15px;" colspan="2">' . $departments_text . '<br><span style="font-size: 17px;padding: 2px; background-color: #d6e0ec;">الجدول الدراسي للفصل الدراسي ' . $term . ' من العام ' . $year . ' </span></td>

        <td style="text-align: left;"><img  style="width: 40px;" src="' . public_path() . '/storage/' . $logo . '" alt=""></td>
    </tr>
</table>';

        $footer = '<table width="100%">
    <tr>
        ' . $footer_text . '
    </tr>
</table>';

        $thead = '<tr  style="height: 16px;">
<th align="center" style="background-color: #FFD966;font-weight:bold;font-size:12px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1.3px solid black;border-top: 2px solid black;padding: 4px;text-align: right;width: 80px;"><div style="font-size:8pt">&nbsp;</div>اليوم<div style="font-size:8pt">&nbsp;</div></th>
<th align="center" style="background-color: #FFD966;font-weight:bold;font-size:12px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1.3px solid black;border-top: 2px solid black;padding: 4px;text-align: right;width: 110px;"><div style="font-size:8pt">&nbsp;</div>الوقت<div style="font-size:8pt">&nbsp;</div></th>
';
        $levels = Level::all();


        foreach ($levels as $level) {
            $thead .= '<th align="center" style="background-color: #FFD966;font-weight:bold;font-size:12px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1.3px solid black;border-top: 2px solid black;padding: 4px;text-align: right;width: 150px"><div style="font-size:8pt">&nbsp;</div> ' . $level->name . '<div style="font-size:8pt">&nbsp;</div></th>';
        }
        $thead .= '</tr>';



        $table = '<table style="border-collapse: collapse;width: 100%;page-break-inside: avoid;">';
        $table .= $thead;
        foreach ($lectures as $day => $times) {
            $rowspanDay = count($times);
            $row = '<tr>';

            if ($rowspanDay > 1) {

                $keys = array_keys($times);
                $row .= '<th align="center" style="background-color: #FFD966;font-weight: :bold;font-size: :15px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1.3px solid black;border-top: 1.3px solid black;padding: 4px;text-align: center;vertical-align: middle;display: flex;justify-content: center;align-items: center;height:100%;min-height: 90px;" rowspan="' . $rowspanDay . '"><div style="font-size:8pt">&nbsp;</div>' . list_days($day) . '<div style="font-size:8pt">&nbsp;</div></th>';
                $row .=  $this->render_time($keys[0], $times[$keys[0]]);
                for ($i = 1; $i < $rowspanDay; $i++) {
                    $row .= $this->render_time($keys[$i], $times[$keys[$i]],  "<tr>", "", $i + 1  == $rowspanDay);
                }
            } else {
                $row .= '<th align="center" style="background-color: #FFD966;font-weight: :bold;font-size: :15px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1.3px solid black;border-top: 1.3px solid black;padding: 4px;text-align: center;vertical-align: middle;display: flex;justify-content: center;align-items: center;height:100%;min-height: 90px;" ><div style="font-size:8pt">&nbsp;</div>' . list_days($day) . '<div style="font-size:8pt">&nbsp;</div></th>';
                $row .= $this->render_times($times);
            }
            $table .= $row;
        }
        $table .= '</table>';
        $filename = 'lectures_schedule.pdf';
        $html = $header . $table . $footer;
        $lg = array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        PDF::setLanguageArray($lg);
        $fontname = \TCPDF_FONTS::addTTFfont('./Arial Bold.ttf', 'TrueTypeUnicode', '', 11);
        PDF::SetFont($fontname, '', 12, '', true);
        PDF::AddPage('L', 'mm', 'B4', true, 'UTF-8', false);
        PDF::writeHTML($html,  true, false, true, false, "");

        PDF::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }

    public function render_lecture($lecture): string
    {
        $block = '<div style="text-align: center;align-content: center;padding: 3px;">';
        $block .= $lecture['subject_name'] . '<br>';
        $block .= implode(', ', array_map(function ($k, $v) {
            return !empty($k) ? $k : $v;
        }, array_keys($lecture['departments']), array_values($lecture['departments']))) . '<br>';
        $block .= "د/" . $lecture['doctor_name'] . '<br>';
        $block .= $lecture['classroom_name'];
        $block .= '</div>';
        return $block;
    }
    public function render_lectures($lectures): string
    {
        $block = count($lectures) <= 0 ? '<td style="background-color:#DEEAF6;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1.3px solid black;border-top: 1.3px solid black;padding: 0;text-align: center;vertical-align: middle;display: flex;flex-direction: column;justify-content: center;min-height: 90px;">' : '<td style="border: 1.3px solid black;padding: 0;text-align: center;vertical-align: middle;display: flex;flex-direction: column;justify-content: center;min-height: 90px;">';
        foreach ($lectures as $index => $lecture) {
            $block .= $this->render_lecture($lecture);
        }
        $block .= '</td>';
        return $block;
    }
    public function render_time($time, $levels, $before = "", $after = "", $border = false): string
    {
        $block = "";
        $rowspanTime = max(array_map('count', $levels));
        if ($rowspanTime > 1) {
            $block .= '<th align="center" style="font-weight: :bold;';
            $block .= $border  ? 'border-bottom: 1.3px solid black;' : '';
            $block .= 'border-left:1.3px solid black;border-right:1.3px solid black;background-color:#FBE4D6;padding: 4px;text-align: center;vertical-align: middle;display: flex;justify-content: center;align-items: center;height:100%;min-height: 90px;" rowspan="' . $rowspanTime . '"><div style="font-size:8pt">&nbsp;</div>' . $time . '</th>';
            $block  .= $this->render_lectures($levels[0]);
            $block .= "</tr>";
            for ($i = 1; $i  < $rowspanTime; $i++) {
                $block .= "<tr>";
                $block  .= $this->render_lectures($levels[$i]);
                $block .= "</tr>";
            }
        } else {
            $block .= '<th align="center" style="font-weight: :bold;';
            $block .= $border  ? 'border-bottom: 1.3px solid black;' : '';
            $block .= 'border-left:2px solid black;border-right:2px solid black;background-color:#FBE4D6;padding: 4px;text-align: center;vertical-align: middle;display: flex;justify-content: center;align-items: center;height:100%;min-height: 90px;" ><div style="font-size:8pt">&nbsp;</div>' . $time . '</th>';
            foreach ($levels as $levelId => $lectures) {
                $block .= $this->render_lectures($lectures);
            }
            $block .= "</tr>";
        }
        return $before . $block . $after;
    }

    public function render_times($times): string
    {
        $block = "";
        $border  =  array_keys($times);
        foreach ($times as $time => $levels) {
            $block .= $this->render_time($time, $levels, "", "", $time == end($border));
        }
        return $block;
    }
}
