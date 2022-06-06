<?php

namespace App\Http\Controllers;

use App\Models\DrugType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $drugTypes = DrugType::all();
        return view('pages.customer.home', compact("drugTypes"));
    }
}
