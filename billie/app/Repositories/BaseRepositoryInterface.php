<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function getModel();

    public function setModel(Model $model);
}
