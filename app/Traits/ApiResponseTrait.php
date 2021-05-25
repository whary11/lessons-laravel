<?php
    namespace App\Traits;
/**
 * 
 */
trait ApiResponseTrait
{
    public $wrong_credenciles = 101;
    public $ok = 200;
    public $not_found = 404;
    public $not_authorized = 401;
    public $server_error = 500;


    /**
         * Return a responseApi JSON response.
         *
         * @param  array|string  $data
         * @param  string  $message
         * @param  int|null  $code
         * @return \Illuminate\Http\JsonResponse
     */
	protected function responseApi($data, string $type = 'success', string $message = null, int $code = 200)
	{
		return response()->json([
			'status' => $type,
			'message' => $message,
			'data' => $data
		], $code);
	}
}
