<?php
    namespace App\Traits;
/**
 * 
 */
trait ResponseTrait
{

    public $wrong_credenciles = 101;
    public $ok = 200;
    public $not_found = 404;
    public function responseTrait($data, $code = 200){
        return response()->json($data, $code);
    }
}
