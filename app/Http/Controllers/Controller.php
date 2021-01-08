<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(title="Demo API Documentation", version="0.1")
     */
    

    /**
     * @OA\Server(url=L5_SWAGGER_CONST_HOST)
     */

    /**
     * @OA\Schema(
     *      schema="response",
     *      title="Response format",
     *      description="Response format of api",
     *      type="object",
     *      required={"status", "message"},
     *      @OA\Property(
     *          property="status",
     *          description="Status",
     *          format="boolean",
     *          example=true
     *      ),
     *      @OA\Property(
     *          property="message",
     *          description="Message",
     *          format="string",
     *          type="string",
     *          example="Response successfull"
     *      ),
     *      @OA\Property(
     *          property="code",
     *          description="code",
     *          format="int64",
     *          type="integer",
     *          example=200
     *      ),
     *      @OA\Property(
     *          property="data",
     *          description="Data",
     *          type="object"
     *      )
     * )
     */
}
