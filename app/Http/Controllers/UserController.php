<?php

namespace App\Http\Controllers;

use App\Services\User\EmailVerify;
use App\Services\User\UserLogin;
use App\Services\User\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

//    public function send( $code)
//    {
//        try {
//            $code = app(EmailVerify::class)->execute($code);
//            return response([
//                'data'=> [
//                    'code'=> $code
//                ]
//            ]);
//        }catch (ValidationException $exception){
//            return response([
//                'errors'=> $exception->validator->errors()->all()
//            ], 422);
//        }
//    }

    public function send(Request $request)
    {
        try {
            $code = app(EmailVerify::class)->execute($request->all());
            return response([
                'data'=> [
                    'code'=> $request
                ]
            ]);
        }catch (ValidationException $exception){
            return response([
                'errors'=> $exception->validator->errors()->all()
            ], 422);
        }
    }


    public function register(Request $request)
    {
        try {
            [$user, $token] = app(UserRegister::class)->execute($request->all());
            return response([
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'token' => $token,
                ]
            ]);
        }catch (ValidationException $exception){
            return response([
                'errors'=> $exception->validator->errors()->all()
            ], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            [$user, $token, $role] = app(UserLogin::class)->execute($request->all());
            return [
                'data' => [
                    'user' => $user,
                    'role' => $role,
                    'token' => $token
                ]
            ];
        } catch (ValidationException $exception) {
            return response([
                'errors' => $exception->validator->errors()->all()
            ], 422);
        } catch (\Exception $exception) {
            if ($exception->getCode() == 401) {
                return response([
                    'error' => $exception->getMessage()
                ], $exception->getCode());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        return response([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'nameAndPhone' => $user->nameAndPhone
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
