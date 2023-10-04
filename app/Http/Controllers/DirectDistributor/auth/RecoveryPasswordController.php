<?php

namespace App\Http\Controllers\DirectDistributor\Auth;

use App\Http\Helper;
use App\Interfaces\DirectDistributorUserDataInterface;
use App\Mail\RecoverPasswordEmail;
use App\Models\DirectDistributorUserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RecoveryPasswordController
{
    public function __construct(
        private DirectDistributorUserDataInterface $user_data,
        private Helper $helper
    ) {}

    public function create(Request $request)
    {
        // Se exisitr o e-mail
        if (isset($request->email)) {
            // Verifico se o e-mail pertence a algum administrador
            $user = DirectDistributorUserData::where('email', $request->email)->first();
            
            if ($user) {
                try {
                    // Registro um token para o usuário
                    $token = $this->user_data->randomToken($user->id);
                    // Faço a construção e envio do e-mail.
                    $content = new RecoverPasswordEmail($user, $token);
                    Mail::to($user->email)->send($content);
                    // retorno
                    return $this->helper->http_response_code_200('An email with instructions to reset the password has been sent.');
                } catch (\Throwable $th) {
                    return $this->helper->http_response_code_500();
                }
            }
            
            return $this->helper->http_response_code_404('This email does not belong to any administrator.');
        }
    }

    public function verifyCode(Request $request)
    { 
        return $this->user_data->verifyCode($request->code);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->user_data->changePasswordForCode($request->all());
    }
}