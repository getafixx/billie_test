<?php

namespace App\Api\V1\Transformers;

use App\BankTransaction;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class BankTransferTransformer extends TransformerAbstract
{

    /**
     * @var array
     */
    protected $defaultIncludes = [
        'entities',
    ];

    /**
     * @param \App\BankTransaction $bankTransaction
     * @return array
     */
    public function transform(BankTransaction $bankTransaction)
    {
        return [
            'amount' => $bankTransaction->amount,
            'bank_transaction_id' => $bankTransaction->uuid,
            'booking_date' => Carbon::parse($bankTransaction->booking_date)->toDateTimeString(),
        ];
    }

    /**
     * @param \App\BankTransaction $bankTransaction
     * @return \League\Fractal\Resource\Collection
     */
    public function includeEntities(BankTransaction $bankTransaction)
    {
        $entities = $bankTransaction->bankTransactionEntities()->get();
        return $this->collection($entities, new BankTransferEntityTransformer);
    }
}
