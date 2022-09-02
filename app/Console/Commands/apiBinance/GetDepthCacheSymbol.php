<?php

namespace App\Console\Commands\apiBinance;

use App\Events\SymbolDepthCacheUpdated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class GetDepthCacheSymbol extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'depth_cache:symbol';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получаем глубину book символа';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $string = '{"BNBBTC"'.Redis::get('depthCache:BNBBTC').'}';
        //$this->info();
        event(new SymbolDepthCacheUpdated($string));
    }
}
