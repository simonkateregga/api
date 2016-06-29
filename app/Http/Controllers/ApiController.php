<?php

namespace App\Http\Controllers;


use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller
{
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Setter for status code
     * 
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Getter for status Code.
     * 
     * @return mixed
     */
    public function getStatusCode() 
    {
        return $this->statusCode;
    }

    /**
     * Respond with 404 error code
     * 
     * @param  string $message 
     * @return Response
     */
    public function respondNotFound($message = 'Not Found') {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)
                    ->respondWithError($message);
    }


    /**
     * Respond with 500 error code
     * 
     * @param  string $message 
     * @return Response
     */
    public function respondInternalError($message = 'Internal Error') {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->respondWithError($message);
    }

    /**
     * Respond with error
     * 
     * @param  string $message
     * @return Response
     */
    public function respondWithError($message) 
    {
        return $this->respond([
                        'error' => [
                            'message' => $message,
                            'status_code' => $this->getStatusCode()
                        ]]);
    }
    /**
     * Create a Json response.
     * 
     * @param  string $message
     * @return Response          
     */
    public function respond($response, $headers = []) {
        return Response::json($response, $this->getStatusCode(), $headers);
    }

    /**
     * Create a successfully created response.
     * 
     * @param  string $message 
     * @return Response
     */
    public function respondCreated($message) {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
                    ->respond([
                        'message' => $message
                        ]);
        
    }

    /**
     * Respond with failed parameter validation.
     * 
     * @param  string $message
     * @return Response
     */
    public function respondFailedValidation($message) {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
                    ->respondWithError($message);
    }
}
