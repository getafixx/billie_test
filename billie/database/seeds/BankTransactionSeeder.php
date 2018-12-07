<?php

use App\BankTransaction;
use App\BankTransactionEntity;
use Faker\Provider\Base as FakerBase;
use Illuminate\Database\Seeder;

class BankTransactionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $bankTransactionCount = 5; //random_int(1, 5);

        // create some transactions
        factory(App\BankTransaction::class, $bankTransactionCount)->create([
            'amount' => 0,
        ]);

        $allTransactions = BankTransaction::all();
        foreach ($allTransactions as $bankTrans) {
            $this->updateTransactionWithEntities($bankTrans);
        }
    }

    /**
     * Create a random number of BankTransactionEntity to an BankTransaction
     * @param BankTransaction $bankTrans
     */
    protected function updateTransactionWithEntities(BankTransaction $bankTrans): void
    {
        $transactionTotal = 0;
        $entityCount = random_int(1, 4);

        //add the BankTransactionEntity to the Order
        for ($bankTransactionEntity = 1; $bankTransactionEntity <= $entityCount; $bankTransactionEntity++) {
            $this->addBankTransactionEntityToBankTransaction($transactionTotal, $bankTrans);
        }

        $bankTrans->amount = $transactionTotal;
        $bankTrans->save();
    }

    /**
     * Add an Bank Transaction Entity to a Bank Transaction.
     * @param int $transactionTotal
     * @param BankTransaction $bankTrans
     */
    protected function addBankTransactionEntityToBankTransaction(&$transactionTotal, BankTransaction $bankTrans): void
    {

        $amount = FakerBase::randomFloat(2, 0, 10000);

        // this needs to be changed - but for the time being its OK
        $transactionTotal += $amount;

        factory(BankTransactionEntity::class, 1)->create([
            'amount'              => $amount,
            'bank_transaction_id' => $bankTrans->uuid,
        ]);


    }
}
