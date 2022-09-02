<?php

namespace App\Http\Controllers\API\V1\Admin\Binance;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSymbolHistoryRequest;
use App\Http\Requests\UpdateSymbolHistoryRequest;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSymbolHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSymbolHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\apiBinance\SymbolHistory  $symbolHistory
     * @return \Illuminate\Http\Response
     */
    public function show(SymbolHistory $symbolHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\apiBinance\SymbolHistory  $symbolHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(SymbolHistory $symbolHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSymbolHistoryRequest  $request
     * @param  \App\Models\apiBinance\SymbolHistory  $symbolHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSymbolHistoryRequest $request, SymbolHistory $symbolHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\apiBinance\SymbolHistory  $symbolHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SymbolHistory $symbolHistory)
    {
        //
    }
}
