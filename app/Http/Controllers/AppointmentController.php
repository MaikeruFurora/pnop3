<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function appoint()
    {
        return view('form/appoint-register');
    }

    public function holidaySave(Request $request)
    {
        return Holiday::updateorcreate(['id' => $request->id], $request->all());
    }

    public function holidayList()
    {
        return response()->json([
            'data' => Holiday::select('id', 'holi_date', 'description')->get()
        ]);
    }
    public function holidayEdit(Holiday $holiday)
    {
        return response()->json($holiday);
    }

    public function holidayDelete(Holiday $holiday)
    {
        return $holiday->delete();
    }

    public function showHolidayList()
    {
        return response()->json(Holiday::select('holi_date')->get());
    }

    public function days_in_month($month, $year)
    {
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    public function showAppointList()
    {
        $lastDayOfMonth = $this->days_in_month(date('m'), date("Y"));
        $lastDateOfMonth = date("m/") . $lastDayOfMonth . date("/Y");
        $currentDate = date('m/d/Y'); //, strtotime(' +1 day')
        return response()->json(
            Appointment::select('set_date', DB::raw('COUNT(set_date) as inTotal'))
                ->whereBetween('set_date', [$currentDate, $lastDateOfMonth])
                ->groupBy('set_date')
                ->orderBy('set_date', 'asc')
                ->get()
        );
    }

    public function appointSave(Request $request)
    {
        $request['appoint_no'] = rand(99, 1000) . '-' . rand(99, 1000);
        $data =  Appointment::create($request->all());
        return redirect('appoint/success/' . $data->id);
    }


    public function showSucccess(Appointment $appointment)
    {
        return view('form/appoint-success', compact('appointment'));
    }

    public function getAvailAppoint($month)
    {
        $lastDayOfMonth = $this->days_in_month(strval($month), date("Y"));
        $lastDateOfMonth = date("m/") . $lastDayOfMonth . date("/Y");
        $currentDate = date('m/d/Y'); //, strtotime(' +1 day')
        $data = Appointment::select('set_date as start', DB::raw('COUNT(set_date) as title'))
            ->whereBetween('set_date', [$currentDate, $lastDateOfMonth])
            ->groupBy('set_date')
            ->orderBy('set_date', 'asc')
            ->get();
        $dataHoliday = Holiday::select("holi_date", "description")->get();
        $arrayData0 = array();
        foreach ($dataHoliday as  $value) {
            $arr = array();
            $datee = strval($value->holi_date . ' ' . date("Y"));
            $arr['start'] = date('Y-m-d', strtotime($datee));
            $arr['title'] = $value->description;
            $arr['backgroundColor'] = "rgba(0, 255, 0, 0)";
            $arr['borderColor'] = "rgba(0, 255, 0, 0)";
            $arr['textColor'] = "#fff";
            $arr['className'] = "holiday";
            $arrayData0[] = $arr;
        }
        $arrayData1 = array();
        foreach ($data as $value) {
            $arr = array();
            $arr['start'] = date('Y-m-d', strtotime($value->start));
            $arr['title'] = "Total - " . $value->title;
            $arr['backgroundColor'] = "rgba(0, 255, 0, 0)";
            $arr['borderColor'] = "rgba(0, 255, 0, 0)";
            $arr['textColor'] =  $value->title > 10 ? "white" : "black";
            $arr['className'] = $value->title > 10 ? "full" : "vacant";
            $arrayData1[] = $arr;
        }

        return response()->json(array_merge($arrayData0, $arrayData1));
    }

    public function selectedDate($selected)
    {
        $formatedDate = date("m/d/Y", strtotime(strtr($selected, '-', '/')));
        return response()->json([
            'data' => Appointment::where('set_date', strval($formatedDate))->get()
        ]);
    }
}
