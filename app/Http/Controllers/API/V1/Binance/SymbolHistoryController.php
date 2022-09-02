<?php

namespace App\Http\Controllers\API\V1\Binance;

use App\Http\Controllers\Controller;
use App\Models\apiBinance\SymbolHistory;

class SymbolHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SymbolHistory::paginate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function symbols()
    {
        //
    }
}
