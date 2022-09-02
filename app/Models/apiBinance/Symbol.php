<?php

namespace App\Models\apiBinance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Symbol extends Model
{
    use SoftDeletes, HasFactory;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $lastCodes = [
        'UPUSDT',
        'DOWNUSDT',
        'BUSD',
        'USDT',
        'BTC',
        'BNB',
        'ETH',
        'AUD',
        'BRL',
        'EUR',
        'GBR',
        'RUB',
        'TRY',
        'USDC',
        'BIDR',
        'GBP',
        'TUSD',
        'UAH',
        'DAI',
        'NGN',
        'TRX',
        'DOGE',
        'USDP',
        'XRP',
        'IDRT',
        'DOT',
    ];

    public $addColumnsSelectHistories = [
        'close',
        'open',
        'high',
        'low',
        'volume',
        'quoteVolume',
        'eventTime',
    ];

    public function setCodes($id = null){
        if ($id) { $this->id = $id; }
        foreach ($this->lastCodes as $value){
            if (Str::endsWith($this->id , $value)) {
                $this->first_code = Str::of($this->id)->beforeLast($value);
                $this->last_code = $value;
                return collect(['first_code' => $this->first_code,'last_code' => $this->last_code ]);
            }
        }
    }

    public function addHistory(){
        return SymbolHistory::firstOrCreate([
            'id' => $this->id,
            'created_at' => $this->created_at
        ],[
            'first_code' => $this->first_code,
            'last_code' => $this->last_code,
            'close' => $this->close,
            'open' => $this->open,
            'high' => $this->high,
            'low' => $this->low,
            'volume' => $this->volume,
            'quoteVolume' => $this->quoteVolume,
            'eventTime' => $this->eventTime,
        ]);
    }

    public function histories(){
        return $this->hasMany(SymbolHistory::class,'id', 'id');
    }

    public function scopeJoinHistory($query, $minutes = [5, 15,30, 60, 240, 1440]){
        $query->select('symbols.*');
        foreach ($minutes as $v){
            $query->historyMinutes($v);
        }
    }

    public function scopeHistoryMinutes($query, $minutes){
        $addselectString = [];
        foreach ($this->addColumnsSelectHistories as $v){
            $addselectString[]  = "symbol_histories_{$minutes}_m.{$v} as h{$minutes}m_{$v}";
        }
        $query->leftJoin("symbol_histories as symbol_histories_{$minutes}_m", function ($join) use ($minutes){
            $join->on('symbols.id', '=', "symbol_histories_{$minutes}_m.id")
                ->on(DB::raw("symbols.created_at - ({$minutes} || ' minutes')::interval"), '=', "symbol_histories_{$minutes}_m.created_at");
        })->addSelect($addselectString);
    }

    /*
    public function scopeHistory5minutes($query){
        $query->leftJoin('symbol_histories as symbol_histories_5_m', function ($join) {
                $join->on('symbols.id', '=', 'symbol_histories_5_m.id')
                     ->on(DB::raw("symbols.created_at - (5 || ' minutes')::interval"), '=', 'symbol_histories_5_m.created_at');
        })->addSelect('symbol_histories_5_m.created_at as h5m_created_at');
    }

    public function scopeHistory15minutes($query){
        $query->leftJoin('symbol_histories as symbol_histories_15_m', function ($join) {
            $join->on('symbols.id', '=', 'symbol_histories_15_m.id')
                 ->on(DB::raw("symbols.created_at - (15 || ' minutes')::interval"), '=', 'symbol_histories_15_m.created_at');
        })->addSelect('symbol_histories_15_m.created_at as h15m_created_at');
    }

    public function scopeHistory30minutes($query){
        $query->leftJoin('symbol_histories as symbol_histories_30_m', function ($join) {
            $join->on('symbols.id', '=', 'symbol_histories_30_m.id')
                ->on(DB::raw("symbols.created_at - (30 || ' minutes')::interval"), '=', 'symbol_histories_30_m.created_at');
        })->addSelect('symbol_histories_30_m.created_at as h30m_created_at');
    }

    public function scopeHistory60minutes($query){
        $query->leftJoin('symbol_histories as symbol_histories_60_m', function ($join) {
            $join->on('symbols.id', '=', 'symbol_histories_60_m.id')
                ->on(DB::raw("symbols.created_at - (60 || ' minutes')::interval"), '=', 'symbol_histories_60_m.created_at');
        })->addSelect('symbol_histories_60_m.created_at as h60m_created_at');
    }

    public function scopeHistory240minutes($query){
        $query->leftJoin('symbol_histories as symbol_histories_240_m', function ($join) {
            $join->on('symbols.id', '=', 'symbol_histories_240_m.id')
                ->on(DB::raw("symbols.created_at - (240 || ' minutes')::interval"), '=', 'symbol_histories_240_m.created_at');
        })->addSelect('symbol_histories_240_m.created_at as h240m_created_at');
    }

    public function scopeHistory1440minutes($query){
        $query->leftJoin('symbol_histories as symbol_histories_1440_m', function ($join) {
            $join->on('symbols.id', '=', 'symbol_histories_1440_m.id')
                ->on(DB::raw("symbols.created_at - (1440 || ' minutes')::interval"), '=', 'symbol_histories_1440_m.created_at');
        })->addSelect('symbol_histories_1440_m.created_at as h1440m_created_at');
    }*/

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_actve', true);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFuture($query)
    {
        return $query->where('is_future', true);
    }





}
