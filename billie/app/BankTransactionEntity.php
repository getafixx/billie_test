<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankTransactionEntity extends Model
{

    const REASON_TYPE_DEBTOR_PAYBACK = 'debtor_payback';
    const REASON_TYPE_BANK_CHARGE = 'bank_charge';
    const REASON_TYPE_PAYMENT_REQUEST = 'payment_request';
    const REASON_TYPE_UNIDENTIFIED = 'unidentified';

    /**
     * The table associated with the model.
     * @var string
     */
    protected $tables = 'bank_transaction_entities';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'amount',
        'reason',
        'bank_transaction_id',
    ];

    /**
     * The attributes that should be mutated to dates.
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

    /**
     * Get the list of Entity reasons for seeding fake data
     * @return mixed
     */
    public static function getReasons(): Array
    {

        return [
            self::REASON_TYPE_DEBTOR_PAYBACK,
            self::REASON_TYPE_BANK_CHARGE,
            self::REASON_TYPE_PAYMENT_REQUEST,
            self::REASON_TYPE_UNIDENTIFIED,
        ];
    }
}
