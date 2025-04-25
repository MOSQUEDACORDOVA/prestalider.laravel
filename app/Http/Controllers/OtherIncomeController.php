<?php

namespace App\Http\Controllers;

use App\OtherIncome;
use Illuminate\Http\Request;

class OtherIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('other_incomes.index');
    }
}
