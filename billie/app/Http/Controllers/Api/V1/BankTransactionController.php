<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\V1\Transformers\BankTransferTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBankTransactionRequest;
use App\Repositories\BankTransactionsRepository;
use App\Services\BankTransactionService;
use GatherContent\LaravelFractal\LaravelFractalFacade as Fractal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;

use League\Fractal\Serializer\JsonApiSerializer;

/**
 * Class BankTransactionController
 * @package App\Http\Controllers\Api\V1
 */
class BankTransactionController extends Controller
{
    /**
     * App\Repositories\BankTransactionsRepository $bankTransactionsRepository
     */
    protected $bankTransactionsRepository;

    /**
     * App\Services\BankTransactionService $bankTransactionService
     */
    protected $bankTransactionService;

    /**
     * BankTransactionController constructor.
     */
    public function __construct(BankTransactionsRepository $bankTransactionsRepository, BankTransactionService $bankTransactionService)
    {
        $this->bankTransactionsRepository = $bankTransactionsRepository;
        $this->bankTransactionService = $bankTransactionService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBankTransaction(string $uuid, Request $request)
    {
        $validator = Validator::make(['uuid'=>$uuid], [
            'uuid'     => 'required|uuid|exists:bank_transactions,uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // should be found if it passes validation.
        $bankTrans = $this->bankTransactionsRepository->findTransaction($uuid);

        return Fractal::item($bankTrans, new BankTransferTransformer());
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBankTransaction(StoreBankTransactionRequest $storeBankTransactionRequest)
    {
        $data = $storeBankTransactionRequest->all();
        if ($this->bankTransactionService->validateBankTransaction($data) === false) {
            return response()->json(
                ['errors' => 'Transaction Amount does not match parts amount'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $bankTrans = $this->bankTransactionService->storeBankTransaction($data);
        
        return Fractal::item($bankTrans, new BankTransferTransformer());
    }
}
