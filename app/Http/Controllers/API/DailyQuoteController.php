<?php

namespace App\Http\Controllers\API;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class DailyQuoteController extends Controller
{
    public function getQuotes()
    {
        $url = "https://zenquotes.io/api/quotes";
        $json = file_get_contents($url);
        $json_data = (array)json_decode($json);
        $collection = Quote::hydrate($json_data);
        $quotes = $collection->flatten();

        return DataTables::of($quotes)
            ->rawColumns(
                [
                    'h',
                ]
            )->make(true);
    }
}
