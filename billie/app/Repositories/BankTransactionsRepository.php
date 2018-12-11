<?php

namespace App\Repositories;

use App\BankTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BankTransactionsRepository implements BaseRepositoryInterface
{
    /**
     * App\BankTransaction $model
     */
    protected $model;

    /**
     * BankTransactionsRepository constructor.
     */
    public function __construct()
    {
        $this->model = new BankTransaction();
    }

    /**
     * @return BankTransaction[] | Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return BankTransaction | Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Get the associated model
     * @return BankTransaction
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the associated model
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function findTransaction($uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }
}
