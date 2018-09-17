<?php

namespace App\Http\Controllers\Api\V1;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
      $request->validate([
          'email' => 'required|string|email',
          'password' => 'required|string'
      ]);

      $credentials = $request->only('email', 'password');

      if(Auth::attempt($credentials))
      {
        $user = Auth::user();
        $user->access_token = $user->generateAccessToken();
        return $this->successResponse('Login Successful', $user, 201);
      }
    }

    public function register(Request $request)
    {
      $rules = [
          'name' => 'required|string',
          'email' => 'required|string|email',
          'password' => 'required|string',
          'role' => ['required',
                    Rule::in('Admin', 'User', 'Guest')
                  ],
      ];
      if($request->input('role') == 'Admin')
      {
        return $this->sendError('Failed', 'You cannot perform this operation', 401);
      }

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails())
      {
          return $this->errorResponse($validate->errors());
      }

      $payload = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'role' => $request->input('role'),
      ];

      $user = User::create($payload);

      try
      {
          $user->access_token = $user->generateAccessToken();
      }
      catch(\Exception $e)
      {
          $user->delete();
          return $this->errorResponse('Unable to generate access token');
      }

      return $this->successResponse('user created', $user);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
