<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Classes\Table;
use App\Classes\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DefaultPrediction;
 

class DashboardController extends Controller
{
    public function index() 
    {
        if (permission::permitted('dashboard')=='fail'){ return redirect()->route('denied'); }
        
        $reference = \Auth::user()->reference;

        $firstname = table::people()->where('id', $reference)->value('firstname');

        $total_employees = table::people()->where('employmentstatus', 'Active')->count();

        $total_attendances = DefaultPrediction::count();



        return view('admin.dashboard', [
        	'total_employees' => $total_employees,
        	'total_attendances' => $total_attendances,
        	
            'firstname' => $firstname,
        ]);
    }

    public function new() 
    {
        return view('admin.new');
    }
}
