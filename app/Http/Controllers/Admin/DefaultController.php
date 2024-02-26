<?php

namespace App\Http\Controllers\admin;

use DB;
use Storage;
use Carbon\Carbon;
use App\Classes\Table;
use App\Classes\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\DefaultPrediction;
use GuzzleHttp\Client;

class DefaultController extends Controller
{
    
    public function index() 
    {
        // if (permission::permitted('attendance')=='fail'){ return redirect()->route('denied'); }
        
        $defaults = DefaultPrediction::orderBy('id', 'desc')->get();


        $time_format = table::settings()->value("time_format");
        
        return view('admin.default', ['default' => $defaults, 'time_format' => $time_format]);
    }

    public function add()
    {
        if (permission::permitted('attendance')=='fail'){ return redirect()->route('denied'); }

        $employee = table::people()->get();

        $time_format = table::settings()->value("time_format");

        return view('admin.default-add', ['employee' => $employee, 'time_format' => $time_format]);
    }

    public function entry(Request $request)
    {
    
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://127.0.0.1:5000/prediction";
        $churn = new Attrition();
      
        $age = request('age');
        $dailyRate=request('daily_rate');
        $distanceFromHome = request('distance_from_home');
        $yearsWithCurrManager = request('years_with_cm');
        $totalWorkingYears = request('total_working_years');
        $hourlyRate = request('hourly_rate');
        $percentSalaryHike = request('percentage_salary_hike');
        $numCompaniesWorked = request('no_of_companies');
        $monthlyIncome = request('monthly_income');
        $monthlyRate = request('monthly_rate');
        
        $params = [
            "Age"=> $age,
            "DailyRate"=>  $dailyRate,
            "DistanceFromHome"=> $distanceFromHome,
            "YearsWithCurrManager"=>  $yearsWithCurrManager,
            "TotalWorkingYears "=> $totalWorkingYears,
            "HourlyRate"=> $hourlyRate,
            "PercentSalaryHike"=> $percentSalaryHike,
            "NumCompaniesWorked"=>  $numCompaniesWorked,
            "MonthlyIncome"=>$monthlyIncome,
            "MonthlyRate"=> $monthlyRate
        ];
        // $churn_params = json_encode($params);
        $headers = [
            
            'Accept' => 'application/json'
        ];
        // $header_params = json_encode($headers);

        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json'=>$params,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody(),true);
        // $data =json_decode($responseBody);

        $result = $responseBody['prediction'];
        
        $churn_result = intval($result);
       
        $churn->employee_id=request('name');
        $churn->churn_status=$churn_result;
        $churn->save();
        if($churn_result == 0){

            return redirect()->back()->with('success', 'This employee is highly likely to leave');   
            // return redirect()-back()->with('success','Customer is predicted not to churn');
        }else if($churn_result == 1){
            return redirect()-back()->with('success','This employee is not highly likely to leave');
        }else{
            return redirect()-back()->with('error','Could not predict attrition!! Try again later..');
        }
    }

    public function delete($id, Request $request)
    {
        if (permission::permitted('attendance-delete')=='fail'){ return redirect()->route('denied'); }

        $id = $request->id;

        table::attendance()->where('id', $id)->delete();

        return redirect('admin/default')->with('success', trans("Default is successfully deleted"));
    }

    public function filter(Request $request)
    {
        if (permission::permitted('attendance')=='fail'){ return redirect()->route('denied'); }
        
        $v = $request->validate([
            'start' => 'required|max:255',
            'end' => 'required|max:255'
        ]);
        
        $start = $request->start;
        
        $end = $request->end;
        
        $time_format = table::settings()->value("time_format");
        
        $attendance = table::attendance()->whereBetween('date', ["$start", "$end"])->get();
        
        return view('admin.default', ['attendance' => $attendance, 'time_format' => $time_format]);
    }

    public function upload() 
    {
       
        return view('admin.upload-data');
    }

    public function process(Request $request) 
    {
       
        // return view('admin.upload-data');
          // Validate the request
          $this->validate($request, [
            'csvFile' => 'required|mimes:csv,txt'
        ]);
        // var_dump("Validated").exit();
        // Get the CSV file from the request
        $file = $request->file('csvFile');

        // Read the contents of the CSV file
        $data = file_get_contents($file->getRealPath());

        // Send the CSV data to the churn prediction API
        try{
            $client = new Client();
        $response = $client->post('http://127.0.0.1:5000/attrition_profiles', [
            'multipart' => [
                [
                    'name' => 'data',
                    'contents' => $data,
                    'filename' => $file->getClientOriginalName()
                ]
            ]
        ]);
        }catch(\Exception $e){

        }
        

        // Get the predictions from the API response
        $predictions = json_decode($response->getBody(), true);
        // var_dump($predictions).exit();
        // $flattenedPredictions = array_map(function($prediction) {
        //     return implode(',', $prediction);
        // }, $predictions);// Save the predictions to a CSV file named churnProfile
        // var_dump($predictions).exit();
        $csvData = array_map(function($row) { return implode(',', (array)$row); }, $predictions);
        Storage::disk('local')->put('employee_attrition.csv', implode("\n", $csvData));
        

        // Prepare the data for the chart
        $chartData = [
            'labels' => array_keys($predictions),
            'values' => array_values($predictions)
        ];

        // Return the dashboard view with the chart data
        return back()->with('success','Mortgage Default Predicted Sucessfully!!');
    }

}

