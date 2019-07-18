<?php
/**
 * Created by PhpStorm.
 * User: MyoThantKyaw
 * Date: 18/07/19
 * Time: 10:24
 */

namespace Module\Infrastructure\BaseResponse;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response as DefaultResponse;

abstract class Response
{
    /**
     * Default Success Integer.
     *
     * @var int
     */
    private static $success = 1;

    /**
     * Default Success Status Code.
     *
     * @var int
     */
    private static $status_code = 200;

    /**
     * This will be return request data response.
     *
     * @param array $data
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success(array $data, $code = null)
    {
        if (!empty($code)) {
            self::$status_code = $code;
        }

        $default = self::defaultJsonResponse();

        $data = array_push($default, ["data" => $data]);

        return DefaultResponse::json($data);
    }

    /**
     * This will be return exception error response.
     *
     * @param $message
     * @param null $code
     * @return int
     */
    public static function exceptions($message, $code = null)
    {
        if (!empty($code) && is_int($code))
            self::$status_code = $code;

        $default = self::defaultJsonResponse();

        $exceptions = array_push($default, [
            "Exceptions" => $message
        ]);

        return $exceptions;
    }

    /**
     * This will be return validation error response.
     *
     * @param array $data
     * @param null $code
     * @return int
     */
    public static function validations(array $data, $code = null)
    {
        if (!empty($code) && is_int($code))
            self::$status_code = $code;

        $default = self::defaultJsonResponse();

        $validations = array_push($default, [
            "validations" => $data
        ]);

        return $validations;
    }

    /**
     * Get route from the request.
     *
     * @return string
     */
    private static function getRoute()
    {
        return URL::current();
    }

    /**
     * Get method from the request.
     *
     * @return string
     */
    private static function getMethod()
    {
        return Request::method();
    }

    /**
     * @return array
     */
    private static function defaultJsonResponse()
    {
        return [
           "success" => self::$success,
           "status code" => self::$status_code,
           "route" => self::getRoute(),
           "method" => self::getMethod()
        ];
    }
}