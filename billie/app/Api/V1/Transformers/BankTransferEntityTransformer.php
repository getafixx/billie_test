<?php

namespace App\Api\V1\Transformers;

use App\BankTransaction;
use App\BankTransactionEntity;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class BankTransferEntityTransformer extends TransformerAbstract
{

    /**
     * @param \App\BankTransactionEntity $bankTransactionEntity
     * @return array
     */
    public function transform(BankTransactionEntity $bankTransactionEntity)
    {
        return [
            'amount' => $bankTransactionEntity->amount,
            'reason' => $bankTransactionEntity->reason,
        ];
    }
}
