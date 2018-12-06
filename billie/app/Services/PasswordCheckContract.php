<?php

namespace App\Services;

interface PasswordCheckContract
{
    /**
     * Check the password passes the validation rules
     * @param string $password
     * @return boolean
     */
    public function checkPassword(string $password);

    /**
     * @return array;
     */
    public function getErrors();
}
