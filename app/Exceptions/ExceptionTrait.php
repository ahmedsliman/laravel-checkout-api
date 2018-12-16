<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait

{
	public function apiException($request, $e)
	{
        if($this->isModel($e)) {
        	return modelResponse($e);
        }

        if($this->isHttp($e)) {
        	return $this->httpResponse($e);
        }

        return parent::render($request, $exception);
	}

	protected function isModel($e)
	{
		retrun ($e instanceof ModelNotFoundException);
	}

	protected function isHttp($e)
	{
		return ($e instanceof NotFoundHttpException);
	}

	protected function modelResponse($e)
	{
        return response()->json([
            'errors' => 'Product model not found!'
        ], Response::HTTP_NOT_FOUND);
	}

	protected function httpResponse($e)
	{
        return response()->json([
            'errors' => 'Incorrect route!'
        ], Response::HTTP_NOT_FOUND);
	}

}