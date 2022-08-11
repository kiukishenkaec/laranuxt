<?php

namespace App\Console\Commands\apiBinance;

use App\Models\apiBinance\Symbol;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class PushDdSymbols extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiBinance:pushDdSymbols {--id=*} {--force} {--all} {--active} {--future}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сохраняем текущее состояние монет в Базу Данных';


    protected $redis_key = 'miniTicker:';


    /*[
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
    ];*/


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ids = array_map('mb_strtoupper',$this->option('id'));
        $active = $this->option('active');
        $future = $this->option('future');
        $force = $this->option('force');
        $all = $this->option('all');


        if ($all) {
            foreach(Redis::keys("{$this->redis_key}*") as $key){
                $newValues = Redis::get($key);
                if ($newValues) {
                    $id = Str::replace($this->redis_key, '',$key);
                    $newValues = json_decode($newValues);

                    $symbolModel = Symbol::firstOrNew(['id' => $id]);

                    if ($symbolModel->exists) {
                        $symbolModel->addHistory();
                    }

                    $symbolModel->close = $newValues->close;
                    $symbolModel->open = $newValues->open;
                    $symbolModel->high = $newValues->high;
                    $symbolModel->low = $newValues->low;
                    $symbolModel->volume = $newValues->volume;
                    $symbolModel->quoteVolume = $newValues->quoteVolume;
                    $symbolModel->eventTime = $newValues->eventTime;

                    $symbolModel->created_at = now()->roundMinute(5); //startOfMinute();

                    $symbolModel->setCodes();
                    $symbolModel->save();
                }
            }
        } else if ($force) {

            foreach ($ids as $id) {
                $newValues = Redis::get("{$this->redis_key}{$id}");

                if ($newValues) {
                    $newValues = json_decode($newValues);

                    $symbolModel = Symbol::firstOrNew(['id' => $id]);

                    $symbolModel->close = $newValues->close;
                    $symbolModel->open = $newValues->open;
                    $symbolModel->high = $newValues->high;
                    $symbolModel->low = $newValues->low;
                    $symbolModel->volume = $newValues->volume;
                    $symbolModel->quoteVolume = $newValues->quoteVolume;
                    $symbolModel->eventTime = $newValues->eventTime;

                    if ($symbolModel->updated_at) {
                        $symbolModel->created_at = $symbolModel->updated_at->roundMinute(5);//startOfMinute();
                    }else {
                        $symbolModel->created_at = now()->roundMinute(5);//startOfMinute();
                    }

                    $symbolModel->setCodes();
                    $symbolModel->save();
                }
            }

        } else {
            $symbols = Symbol::query();
            if ($ids) $symbols = $symbols->whereIn('id',$ids);
            if ($active) $symbols->active();
            if ($future) $symbols->future();

            foreach ($symbols->cursor() as $symbolModel) {
                $newValues = Redis::get("miniTicker:{$symbolModel->id}");

                if ($newValues) {
                    $newValues = json_decode($newValues);

                    $symbolModel->close = $newValues->close;
                    $symbolModel->open = $newValues->open;
                    $symbolModel->high = $newValues->high;
                    $symbolModel->low = $newValues->low;
                    $symbolModel->volume = $newValues->volume;
                    $symbolModel->quoteVolume = $newValues->quoteVolume;
                    $symbolModel->eventTime = $newValues->eventTime;
                    $symbolModel->save();
                }
            }
        }

    }

}
