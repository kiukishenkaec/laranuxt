<?php

namespace App\Events;

use App\Http\Resources\API\V1\Binance\SymbolResource;
use App\Models\apiBinance\Symbol;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SymbolStatusUpdated  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, InteractsWithBroadcasting;


    /**
     * The order instance.
     *
     * @var Symbol
     */
    public $symbol;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Symbol $symbol)
    {
        $this->symbol = $symbol;
    }


    public function broadcastWith()
    {
        return ['symbol' => new SymbolResource($this->symbol)];
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('symbols');
    }

}
