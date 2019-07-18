<?php
/**
 * Created by PhpStorm.
 * User: MyoThantKyaw
 * Date: 18/07/19
 * Time: 10:27
 */

namespace Module\Infrastructure\BaseValidator;

use Illuminate\Support\Facades\Validator as DefaultValidator;
use Module\Infrastructure\Exceptions\ValidationException;

abstract class Validator extends DefaultValidator
{
    /**
     * Throw validation exception, When user input data is wrong.
     *
     * @param $input
     * @param $rule
     * @throws ValidationException
     */
    public function validate($input, $rule)
    {
        $validator = DefaultValidator::make($input, $rule);
        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }
    }
}