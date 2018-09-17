<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected function successResponse($message, $data=null, $code=200)
  {
    return response()->json([
      'errors' => null,
      'data' => $data,
      'message' => $message,
      'status' => 'success'
    ], $code);
  }

  public function sendError($error, $errorMessages = [], $code = 400)
  {
    $response = [
      'code' => $code,
      'message' => $error,
    ];
    if(!empty($errorMessages)){
      $response['data'] = $errorMessages;
    }
    return response()->json($response, $code);
  }

  protected function errorResponse($errors, $message=null, $code=200) {

      if($errors instanceof MessageBag)
      {
          $errors = $this->extractErrorMessageFromArray($errors->getMessages());

      } else if(is_array($errors))
      {
          $errors = $this->extractErrorMessageFromArray($errors);
      }

      return response()->json([
          'errors' => $errors,
          'data' => null,
          'message' => $errors,
          'status' => 'error'
          ], $code);
  }  
}
