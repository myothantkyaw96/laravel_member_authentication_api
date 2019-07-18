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
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as DefaultController;
use Module\Infrastructure\BaseResponse\Response;

abstract class Controller extends DefaultController
{
    use Notifiable, DispatchesJobs, ValidatesRequests;

    protected function response()
    {
        //
    }
}