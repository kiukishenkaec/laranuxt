<?php

namespace App\Models\apiBinance;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\MassPrunable;

class SymbolHistory extends Model
{
    use HasFactory, MassPrunable; //Prunable;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDay());
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        /*static::addGlobalScope('defaultSorting', function (Builder $builder) {
            $builder->latest();
        });*/
    }
}
