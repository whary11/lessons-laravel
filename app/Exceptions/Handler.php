<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

   

        /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {

        // dd($exception->errors());
        // Execpciones de los from request
        if ($exception instanceof ValidationException) {            
            return  $this->responseApi($exception->errors(),'error','Error de validación',$exception->status);
        }else if($exception instanceof NotFoundHttpException){
            // La url no existe
            return  $this->responseApi([],'error',"El recurso no existe.", $this->not_found);
        }else if($exception instanceof AuthorizationException){
            // La url no existe
            return  $this->responseApi([],'error',"No autorizado", $this->not_authorized);
        }

        return parent::render($request, $exception);
    }

}
