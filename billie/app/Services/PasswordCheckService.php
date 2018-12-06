<?php

namespace App\Services;

use App\Repositories\PasswordRulesRepository;

class PasswordCheckService implements PasswordCheckContract
{

    /**
     * @var \App\Repositories\PasswordRulesRepository
     */
    protected $passwordRulesRepository;

    /**
     * @var array
     */
    protected $passwordRules;


    /**
     * @var array
     */
    protected $errors;

    /**
     * @var array
     */
    protected $passed;


    /**
     * @param \App\Repositories\PasswordRulesRepository $passwordRulesRepository
     */
    public function __construct(PasswordRulesRepository $passwordRulesRepository)
    {
        $this->passwordRulesRepository = $passwordRulesRepository;
        $this->setErrors([]);
        $this->setPassed([]);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password)
    {
        $rules = $this->passwordRulesRepository->loadPasswordRules();

        // if no rules exist then just exit
        if (!is_array($rules)) {
            return false;
        }

        // reset the error and passed message arrays
        $errors = [];
        $passed = [];

        foreach ($rules as $key => $rule) {
            $passed[$key] = true;
            if ($this->regexCheckPasswordPregGrep($password, $rule) === false) {
                $errors[$key] = $rule['error'];
                $passed[$key] = false;
            }
        }

        $this->setErrors($errors);
        $this->setPassed($passed);

        if (count($errors) > 0) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getPassed(): array
    {
        return $this->passed;
    }

    /**
     * @param array $passed
     */
    public function setPassed(array $passed): void
    {
        $this->passed = $passed;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @param string $password
     * @param string $regex
     * @return boolean
     */
    protected function regexCheckPasswordPregGrep(string $password, array $check)
    {
        // if the test produces an empty array, the test has failed.
        $found = (preg_grep($check['regex'], [$password]) === []) ? true : false;

        // I tried to get the negative regex to work for the no repeating chars
        // this was the best way to flip that.
        if ($check['flip']) {
            $found = !$found;
        }

        if ($found) {
            return false;
        }

        return true;
    }
}
