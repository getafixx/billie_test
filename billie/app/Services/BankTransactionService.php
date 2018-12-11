<?php

namespace App\Services;

use App\Repositories\BankTransactionEntitiesRepository;
use App\Repositories\BankTransactionsRepository;

class BankTransactionService //implements BankTransactionContract
{

    /**
     * @var \App\Repositories\BankTransactionsRepository
     */
    protected $bankTransactionsRepository;

    /**
     * @var \App\Repositories\BankTransactionsRepository
     */
    protected $bankTransactionsEntityRepository;


    /**
     * @param \App\Repositories\BankTransactionsRepository $passwordRulesRepository
     */
    public function __construct(
        BankTransactionsRepository $bankTransactionsRepository,
        BankTransactionEntitiesRepository $bankTransactionEntitiesRepository
    ) {
        $this->bankTransactionsRepository = $bankTransactionsRepository;
        $this->bankTransactionEntitiesRepository = $bankTransactionEntitiesRepository;
    }

    /**
     * check that the parts add up to the total
     *
     * @param array $data
     * @return bool
     */
    public function validateBankTransaction(array $data)
    {
        $parts = collect($data['parts']);
        return ($parts->sum('amount')==$data['amount']);
    }

    /**
     * @param array $data
     * @return \App\BankTransaction|\Illuminate\Database\Eloquent\Model
     */
    public function storeBankTransaction(array $data)
    {
        $bankTransTemp = [
            'amount' => $data['amount'],
            'booking_date' => $data['date'],
            'uuid' => $this->uuid()
        ];

        $bankTrans = $this->bankTransactionsRepository->create($bankTransTemp);

        foreach ($data['parts'] as $part) {
            $part['bank_transaction_id'] = $bankTrans->uuid;
            $this->bankTransactionEntitiesRepository->create($part);
        }

        $bankTrans = $this->bankTransactionsRepository->findTransaction($bankTrans->uuid);

        return $bankTrans;
    }

    /**
     * https://developer.wordpress.org/reference/functions/wp_generate_uuid4/
     *
     * @return string (uuid)
     */
    public function uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
