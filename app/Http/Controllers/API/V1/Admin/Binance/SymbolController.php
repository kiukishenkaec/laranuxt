<?php

namespace App\Http\Controllers\API\V1\Admin\Binance;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSymbolRequest;
use App\Http\Requests\UpdateSymbolRequest;
use App\Http\Resources\API\V1\Binance\SymbolResource;
use App\Models\apiBinance\Symbol;

class SymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSymbolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSymbolRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\apiBinance\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function show(Symbol $symbol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\apiBinance\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function edit(Symbol $symbol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSymbolRequest  $request
     * @param  \App\Models\apiBinance\Symbol  $symbol
     * @return SymbolResource
     */
    public function update(UpdateSymbolRequest $request, $id)
    {
        $symbol = Symbol::findOrFail($id);
        $symbol->is_active = $request->is_active;
        $symbol->is_future = $request->is_future;
        $symbol->save();

        return (new SymbolResource($symbol));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\apiBinance\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symbol $symbol)
    {
        //
    }

}
