<?php

namespace App\Http\Resources\API\V1\Binance;

use Illuminate\Http\Resources\Json\JsonResource;

class SymbolHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = [
            'id' => $this->id,
            'first_code' => $this->first_code,
            'last_code' => $this->last_code,
            'close' => $this->close,
            'open' => $this->open,
            'high' => $this->high,
            'low' => $this->low,
            'volume' => $this->volume,
            'quoteVolume' => $this->quoteVolume,
            'eventTime' => $this->eventTime,
            'is_active' => $this->is_active,
            'is_future' => $this->is_future,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        $arr['history_5_min'] = [
            'close' => $this->h5m_close,
            'open' => $this->h5m_open,
            'high' => $this->h5m_high,
            'low' => $this->h5m_low,
            'volume' => $this->h5m_volume,
            'quoteVolume' => $this->h5m_quoteVolume,
            'eventTime' => $this->h5m_eventTime,
        ];

        $arr['history_15_min'] = [
            'close' => $this->h15m_close,
            'open' => $this->h15m_open,
            'high' => $this->h15m_high,
            'low' => $this->h15m_low,
            'volume' => $this->h15m_volume,
            'quoteVolume' => $this->h15m_quoteVolume,
            'eventTime' => $this->h15m_eventTime,
        ];

        $arr['history_30_min'] = [
            'close' => $this->h30m_close,
            'open' => $this->h30m_open,
            'high' => $this->h30m_high,
            'low' => $this->h30m_low,
            'volume' => $this->h30m_volume,
            'quoteVolume' => $this->h30m_quoteVolume,
            'eventTime' => $this->h30m_eventTime,
        ];

        $arr['history_60_min'] = [
            'close' => $this->h60m_close,
            'open' => $this->h60m_open,
            'high' => $this->h60m_high,
            'low' => $this->h60m_low,
            'volume' => $this->h60m_volume,
            'quoteVolume' => $this->h60m_quoteVolume,
            'eventTime' => $this->h60m_eventTime,
        ];

        $arr['history_240_min'] = [
            'close' => $this->h240m_close,
            'open' => $this->h240m_open,
            'high' => $this->h240m_high,
            'low' => $this->h240m_low,
            'volume' => $this->h240m_volume,
            'quoteVolume' => $this->h240m_quoteVolume,
            'eventTime' => $this->h240m_eventTime,
        ];

        $arr['history_1440_min'] = [
            'close' => $this->h1440m_close,
            'open' => $this->h1440m_open,
            'high' => $this->h1440m_high,
            'low' => $this->h1440m_low,
            'volume' => $this->h1440m_volume,
            'quoteVolume' => $this->h1440m_quoteVolume,
            'eventTime' => $this->h1440m_eventTime,
        ];

        return $arr;
    }
}
