<?php

namespace App\Http\Controllers\API\V1\Binance;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Binance\SymbolResource;
use App\Models\apiBinance\Symbol;

class SymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SymbolResource::collection(Symbol::joinHistory()->get());
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
    public function histories()
    {
        //
    }
}
