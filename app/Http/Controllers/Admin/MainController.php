<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response as illuminateResponse;

class MainController extends Controller
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondValidationError($message = 'Validation Error Check Your Parameter')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    public function respondBadRequest($message = 'Something Went Wrong With Request')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
    }

    public function respondUnAuthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    protected function respondAccessDenied($message = 'Access denied')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }

    protected function respondCreated($message)
    {
        return $this->setStatusCode(illuminateResponse::HTTP_CREATED)->respond([
            'message' => $message,
        ]);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'message' => $message,
            'status_code' =>422
        ]);
    }
    
    public function respondWithErrors($message)
    {
        return $this->respond([
            'message' => $message,
            'status_code' =>500
        ]);
    }

    public function respondWithErrorss($message)
    {
        return $this->respond([
            'message' => $message,
            'status_code' =>400
        ]);
    }

    public function respondWithSuccess($message)
    {
        return $this->respond([
            'message' =>$message,
            'status_code' =>$this->getStatusCode()
        ]);
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return response()->json(['data' => $data], $this->getStatusCode(), $headers);
    }

    protected function respondWithPagination(LengthAwarePaginator $paginatedResult,$data)
    {
        $data = array_merge($data, [

            'paginator' => [
                'totalCount' => $paginatedResult->total(),
                'totalPages' => ceil($paginatedResult->total() / $paginatedResult->perPage()),
                'currentPage' => $paginatedResult->currentPage(),
                'limit' => $paginatedResult->perPage()
            ]
        ]);

        return $this->respond($data);
    }

    /**
     * this will be a hook after collection results
     * from resources
     * @param $results
     * @return mixed
     */
    public function indexQueryResult($results)
    {
        return $results;
    }

    /**
     * this method used for show , destroy , update to find the model
     * @param $id
     * @return mixed
     */
    public function findModel($id)
    {
        return ($this->model)::find($id);
    }
    
    /**
     * this will return the resource class
     * @return mixed
     */
    public function resourceClass()
    {
        return $this->resourceOrRequestClass('resource');
    }

    /**
     * this method if the property of resource or request
     * not exist it will try to dynamically get the resource or request class
     * from the model and in this case it will return
     * App/Http/Resources/User/UserResource for example
     * or App/Http/Requests/User/UserRequest
     * @return mixed
     */
    public function resourceOrRequestClass($property , $classPrefix = '')
    {
        if(isset($this->{$property}))
        {
            return $this->{$property};
        }

        $className = str_singular(class_basename(get_class(new $this->model)));

        $requestOrResource = str_contains($property,'resource') ? 'Resources' : 'Requests';

        return 'App'.'\\Http\\'.$requestOrResource.'\\'.$className.'\\'.ucfirst(str_singular($classPrefix)).$className.str_singular($requestOrResource);
    }

    /**
     * this will return the translation message key name
     * or it will return model as a string
     * @return string
     */
    public function messageKeyName()
    {
        if(isset($this->message))
        {
            return $this->message;
        }

        return 'model';
    }
}