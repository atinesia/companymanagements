<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class DailyQuoteController extends Controller
{
    public function index()
    {
        return view('admin.dailyquotes');
    }
}
