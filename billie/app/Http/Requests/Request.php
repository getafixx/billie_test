<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Request extends FormRequest
{
    /**
     * Validate the input.
     *
     * @param  \Illuminate\Validation\Factory  $factory
     * @return \Illuminate\Validation\Validator
     */
    public function validator($factory)
    {
        return $factory->make(
            $this->sanitizeInput(),
            $this->container->call([$this, 'rules']),
            $this->messages()
        );
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
   /* public function response(array $errors)
    {

        return new JsonResponse($errors, 422);

    }*/

    /**
     * Sanitize the input.
     *
     * @return array
     */
    protected function sanitizeInput()
    {
        if (method_exists($this, 'sanitize')) {
            return $this->container->call([$this, 'sanitize']);
        }

        return $this->all();
    }

    /**
     * Null blank data..
     *
     * @return array
     */
    public function nullBlankData()
    {
        $newData = $this->all();
        foreach ($this->all() as $key => $value) {
            if ($value == '') {
                $newData[$key] = null;
            }
        }

        return $newData;
    }
}
