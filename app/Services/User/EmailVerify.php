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
    public function execute(array $data): array
    {
        $this->validate($data);

        $code = $data['code'];
        $user_verify = VerifyUser::where('code', $code)->first();
        if(isset($user_verify)){
            $user = $user_verify->user;
            if (!$user->verified){
                $user_verify->user->verified = 1;
                $user_verify->user->save();
            }
        }

        return ['Your e-mail is verified'];
    }
}
