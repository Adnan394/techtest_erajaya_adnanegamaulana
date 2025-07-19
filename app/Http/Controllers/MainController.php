<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Gender;
use App\Models\Company;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeePeriod;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $data = EmployeePeriod::query();
        if ($request->company) {
            $data->where('company_id', $request->company);
        }

        if ($request->division) {
            $data->where('division_id', $request->division);
        }

        if ($request->level) {
            $data->where('level_id', $request->level);
        }

        if ($request->gender) {
            $data->where('gender_id', $request->gender);
        }

        $company = Company::all();
        $division = Division::all();
        $level = Level::all();
        $gender = Gender::all();

        $data = $data->selectRaw('period, COUNT(*) as total')
             ->groupBy('period')
             ->get();
        
        return view('welcome', compact('company', 'division', 'level', 'gender', 'data'))->with('request', $request);
    }
}