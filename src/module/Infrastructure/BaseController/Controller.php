<?php
/**
 * Created by PhpStorm.
 * User: MyoThantKyaw
 * Date: 18/07/19
 * Time: 10:22
 */

namespace Module\Infrastructure\BaseController;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Module\Infrastructure\BaseResponse\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as DefaultController;

abstract class Controller extends DefaultController
{
    use Notifiable, DispatchesJobs, ValidatesRequests;

    /**
     * Call this function for json response.
     *
     * @param $data
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($data, $code = null)
    {
        return Response::success($data, $code);
    }
}