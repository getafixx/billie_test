<?php

namespace App\Services;

interface BankTransactionContract
{
    /**
     * Check the password passes the validation rules
     * @param string $password
     * @return boolean
     */
    public function store();

    /**
     * @return array;
     */
    public function getErrors();
}
