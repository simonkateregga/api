<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests;

class ApiController extends Controller
{
    protected $statusCode = 200;

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
        return $this->setStatusCode(404)
                    ->respondWithError($message);
    }


    /**
     * Respond with 500 error code
     * 
     * @param  string $message 
     * @return Response
     */
    public function respondInternalError($message = 'Internal Error') {
        return $this->setStatusCode(500)
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
                            'status code' => $this->getStatusCode()
                        ]]);
    }
    /**
     * Create a Json response.
     * 
     * @param  string $message
     * @return Response          
     */
    public function respond($response) {
        return Response::json($response);
    }
}
