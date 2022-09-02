<?php

namespace App\Console\Commands;

use App\Models\apiBinance\Symbol;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

//use Illuminate\Support\Facades\Redis;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test';


    protected $symbol = [
        'id' => '',
        'first_code' => '',
        'last_code' => '',
        'close' => '',
        'open' => '',
        'high' => '',
        'low' => '',
        'volume' => '',
        'quoteVolume' => '',
        'eventTime' => '',
        'is_active' => false,
        'is_future' => false,
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        Redis::psubscribe(['miniTicker:*'], function ($message, $channel) {
            $modelSymbol = $this->prepareModelSymbol($channel, $message);
            //echo $channel . $message . PHP_EOL;
        });

    }

    public function prepareModelSymbol($channel, $message) {
        $id = Str::of($channel)->replace('miniTicker:','');

        echo $channel . $message . PHP_EOL;

        $this->symbol = [
            'id' => $id,
            'close' => '',
            'open' => '',
            'high' => '',
            'low' => '',
            'volume' => '',
            'quoteVolume' => '',
            'eventTime' => '',
            'is_active' => false,
            'is_future' => false,
        ];

        return Symbol::setCodes();
    }

    public function pushDb () {

    }

}
