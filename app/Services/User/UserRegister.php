<?php

namespace App\Services\User;

use App\Mail\SendMAil;
use App\Models\Category;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $date = date('Y-m-d H:i:s');

        $user = User::create([
            'name'=> $data['name'],
            'phone'=> $data['phone'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'email_verified_at'=> $date,
            'is_admin'=> false,
        ]);


        Mail::to($data['email'])->send(
            new SendMAil([
                'name'=>'Muhammad',
            ])
        );
        $token = $user->createToken('user model', ['user'])->plainTextToken;
        return [$user, $token];
    }
}
