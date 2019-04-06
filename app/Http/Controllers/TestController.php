<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/api/test",
     *     description="返回测试内容",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"测试"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="reason",
     *         type="string",
     *         description="拿数据的理由",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function index(Request $request)
    {
        return response()->json([
            'result'    => [
                'statistics' => [
                    'users' => [
                        'name'  => 'Name',
                        'email' => 'user@example.com'
                    ]
                ],
            ],
            'message'   => '',
            'type'      => 'success',
            'status'    => 0
        ]);
    }
}