<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_Offence;
use App\Models\Offended;
use App\Models\Offender;
use App\Models\Officer;
use App\Models\Station;
use App\Models\TimeLog;
use App\Models\User;
use App\Models\Witness;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
      $maleMonthlyOffenderCount=Offender::where('gender','male')->count();
      $femaleMonthlyOffenderCount=Offender::where('gender','female')->count();
      $otherMonthlyOffenderCount=Offender::where('gender','other')->count();
      $allOffendersCount=Offender::all()->count();
      $allOfficersCount=Officer::all()->count();
      $maleOfficersCount=Officer::where('gender', 'male')->count();
      $femaleOfficersCount=Officer::where('gender', 'female')->count();
      $femaleMonthlyWitness=Witness::where('gender', 'female')->count();
      $maleMonthlyWitness=Witness::where('gender', 'male')->count();
      $allActiveUsers=User::where('status', ['active'])->count();
      $allStations=Station::all()->count();
      $allBookings=Booking::all()->count();
      $thisMonthBookings=Booking::all()->count();
      $datachart = [];
      $labelschart = [];

      $yearlyMonth = Booking::whereYear('created_at', Carbon::now()->year)
        ->select(DB::raw('MONTH(created_at) as month'))->get()->toArray();
        $yearlyCount = Booking::whereYear('created_at', Carbon::now()->year)
        ->select(DB::raw('COUNT(*) as count'))->get()->toArray();
      $data = [
        'labels' => [],
        'data' => []
      ];

      for ($i = 1; $i <= 12; $i++) {
        $monthData = array_values(array_filter($yearlyMonth, function ($item) use ($i) {
          return $item['month'] == $i;
        }));
        $count = array_values(array_filter($yearlyCount, function ($item) use ($i) {
          return $item['count'] == $i;
        }));
        if (!empty($monthData)) {
          $data['data'][] = $monthData[0]['month'];
        } else {
          $data['data'][] = 0;
        }

        $data['labels'][] = date('F', mktime(0, 0, 0, $i, 1));
      }

      $yearlyData = json_encode($data);

      $chart = DB::table('offenders')
        ->select(DB::raw('COUNT(*) as total'), DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, dob) / 365.25 / 10) * 10 + 18 AS age'))
        ->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
        ->groupBy(DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, dob) / 365.25 / 10) * 10 + 18'))
        ->orderBy('age')
        ->get()
        ->toArray();

      foreach ($chart as $item) {
        $labelschart[] = $item->age . ' - ' . ($item->age + 9);
        $datachart[] = $item->total;
      }
      $dates = Offender::all()->pluck('date')->toArray();
      $BarChart = Offender::select(
        DB::raw("MONTH(updated_at) as month"),
        DB::raw("YEAR(updated_at) as year"),
        DB::raw("COUNT(*) as count"),
        DB::raw("gender")
          )
        ->whereRaw("created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 2 MONTH)")
        ->groupBy('year', 'month', 'gender')
        ->get();
      $maleDatabar = [];
      $femaleDatabar = [];

      $monthsbar = [];

      for ($i = 2; $i >= 0; $i--) {
        $month = date('m', strtotime("-$i month")); // get the month number
        $year = date('Y', strtotime("-$i month")); // get the year
        $monthsbar[] = date("M Y", strtotime($year . '-' . $month . '-01')); // format the date as "M Y"
        $maleCount = $BarChart->where('gender', 'male')->where('month', $month)->where('year', $year)->sum('count');
        $femaleCount = $BarChart->where('gender', 'female')->where('month', $month)->where('year', $year)->sum('count');
        $maleData[] = $maleCount;
        $femaleData[] = $femaleCount;
      }

      $labelsbar = collect($monthsbar);

      $mdata = [
        'labels' => $labelsbar,
        'datasets' => [
          [
            'label' => 'Male',
            'backgroundColor' => '#007bff',
            'data' => $maleData,
          ],
          [
            'label' => 'Female',
            'backgroundColor' => '#fd6b37',
            'data' => $femaleData,
          ]
        ]
      ];

      $chartDataL = [
        'labels' => $dates,
        'datasets' => [
          [
            'label' => 'Offenders',
            'fill' => true,
            'backgroundColor' => 'rgba(39, 128, 243,0.2)',
            'borderColor' => 'rgba(39, 128, 243,1)',
            'borderWidth' => 2,
            'pointRadius' => 1,
            'pointBackgroundColor' => 'rgba(39, 128, 243,1)',
            'pointBorderColor' => '#D16E38',
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => 'rgba(39, 128, 243,1)',
            'pointHoverBorderColor' => 'rgba(208, 111, 57,1)',
            'data' => $allOffendersCount,
          ]
        ]
      ];
      $BarChart = json_encode($mdata);

      $allOffendedCount = Offended::all()->count();
      return view('dashboard',
          compact(
            'maleMonthlyOffenderCount',
            'femaleMonthlyOffenderCount',
            'otherMonthlyOffenderCount',
            'allOfficersCount',
            'maleOfficersCount',
            'femaleOfficersCount',
            'femaleMonthlyWitness',
            'maleMonthlyWitness',
            'allActiveUsers',
            'allStations',
            'thisMonthBookings',
            'allBookings',
            'allOffendersCount',
            'allOffendedCount',
            'chartDataL',
            'BarChart',
            'labelschart',
            'datachart',
            'yearlyData'
          ));
    }
}
