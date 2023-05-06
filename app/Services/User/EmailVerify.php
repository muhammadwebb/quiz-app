<?php

namespace App\Services\User;

use App\Models\VerifyUser;
use App\Services\BaseService;
use Illuminate\Validation\ValidationException;

class EmailVerify extends BaseService
{
    public function rules(): array
    {
        return [
            'code'=> 'required'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): array
    {
        $this->validate($data);

        $code = $data['code'];
        $user_verify = VerifyUser::where('code', $code)->first();
        $date = $user_verify->created_at;
        if(isset($user_verify)){
            $user = $user_verify->user;
            if (!$user->verified){
                $user_verify->user->is_admin = true;
                $user_verify->user->is_premium = true;
                $user_verify->user->email_verified_at = now();
                $user_verify->user->save();
            }
        }
        return ['Your e-mail is verified'];
    }
}
