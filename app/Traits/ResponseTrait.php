<?php

namespace App\Traits;

trait ResponseTrait
{
    public function errorResponse($message = null, $data = null)
    {
        $response = [
            'code' => 422,
            'status' => 'error',
            'data' => $data,
            'message' => $message ? $message : 'Unprocessable Entity'
        ];
        return response()->json($response, $response['code']);
    }
    public function validationResponse($errors)
    {
        $response = [
            'code' => 400,
            'status' => 'validation error',
            'errors' => $errors
        ];
        return response()->json($response, $response['code']);
    }


    public function mobileValidationResponse($errors)
    {
        $response = [
            'code' => 400,
            'status' => 'validation error',
            'errors' => $errors
        ];
        return response()->json(['error' => $response], $response['code']);
    
    }

    public function unauthorizedResponse($message = "Unauthorized")
    {
        $response = [
            'code' => 401,
            'status' => 'unauthorized',
            'message' => $message
        ];
        return response()->json($response, $response['code']);
    }

    protected function successResponse($message = null, $data = null)
    {
        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function createdResponse($message = null, $data = null)
    {
        $response = [
            'code' => 201,
            'status' => 'created',
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $response['code']);
    }


    protected function notFoundResponse($message = null)
    {
        $response = [
            'code' => 404,
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => $message ? $message : 'Record Not Found'
        ];
        return response()->json($response, $response['code']);
    }

    protected function wrongCredentialsResponse($message = null)
    {
        $response = [
            'code' => 403,
            'status' => 'error',
            'data' => '',
            'message' => $message ? $message : 'You have entered an invalid email or password'
        ];
        return response()->json($response, 208);
        //      return response()->json($response, $response['code']);
    }
}