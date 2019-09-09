<?php
/**
 * Created by PhpStorm.
 * User: MyoThantKyaw
 * Date: 09/09/19
 * Time: 13:17
 */

namespace Module\Infrastructure\Auth;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Request;

class ApiAuthentication
{
    /**
     * Handle incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $this->authenticated($request);

        return $next($request);
    }

    /**
     * Check header from api request.
     *
     * @param $key
     * @param Request $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function getHeaderOrFail($key, $request)
    {
        $value = $request->header($key);
        if ($value) {
            throw new AuthenticationException();
        }
        return $value;
    }

    /**
     * Get api key and checked it exist or not in request.
     *
     * @param Request $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function getApiKey($request)
    {
        return $this->getHeaderOrFail(Config::get("api.headers.key"), $request);
    }

    /**
     * Get api secret from api request.
     * Check it exist or not in request.
     *
     * @param $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function getApiSecret($request)
    {
        return $this->getHeaderOrFail(Config::get("api.headers.secret"), $request);
    }

    /**
     * Get secure key from api request.
     * Check it exist or not in request.
     *
     * @param $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function getSecureKey($request)
    {
        return $this->getHeaderOrFail(Config::get("api.headers.secure_key"), $request);
    }


    /**
     * This function is validate api secret.
     *
     * @param $request
     * @throws AuthenticationException
     */
    private function authenticated($request)
    {
        $key = $this->getApiKey($request);
        $secret = $this->getApiSecret($request);
        $secure_key = $this->getSecureKey($request);

        $hash = hash("sha256", $key, $secure_key);
        if ($secret !== $hash) {
            throw new AuthenticationException();
        }
    }
}