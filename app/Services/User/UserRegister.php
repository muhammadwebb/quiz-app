<?php

namespace App\Services\User;

use App\Mail\SendMAil;
use App\Models\User;
use App\Models\VerifyUser;
use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserRegister extends BaseService
{
    public function rules(): array
    {
        return [
            'name'=> 'required',
            'phone'=> 'required|unique:users,phone',
            'email'=> 'nullable|unique:users,email',
            'password'=> 'required',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): array
    {
        $this->validate($data);

        $user = User::create([
            'name'=> $data['name'],
            'phone'=> $data['phone'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'is_admin'=> false,
            'is_premium'=> false,
            'verified'=> false
        ]);
        $token = $user->createToken('user model', ['user'])->plainTextToken;


        $code = rand(1111, 9999);
        $verifyUser = VerifyUser::create([
            'user_id'=> $user['id'],
            'code'=> $code
        ]);


        Mail::to($user->email)->send(
            new SendMAil([
                'name'=>$user->name,
                'email'=> $user->email,
                'code'=> $code
            ])
        );

        return [$user, $token];
    }
}
