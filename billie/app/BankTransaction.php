<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $tables = 'bank_transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'amount',
        'booking_date',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'booking_date',
        'created_at',
        'updated_at',
    ];


    /**
     * The Bank Transaction Entities relationship.
     * @return HasMany
     */
    public function bankTransactionEntity(): HasMany
    {
        return $this->hasMany(BankTransactionEntity::class);
    }
}
