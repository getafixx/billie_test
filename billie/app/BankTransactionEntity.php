<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankTransactionEntity extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $tables = 'bank_transaction_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'reason',
        'bank_transaction_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The Product relationship.
     * @return BelongsTo
     */
    public function bankTransaction(): BelongsTo
    {
        return $this->belongsTo(BankTransaction::class);
    }
}

