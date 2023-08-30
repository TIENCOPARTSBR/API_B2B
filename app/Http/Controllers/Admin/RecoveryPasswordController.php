<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helper;
use App\Interfaces\AdminRepositoryInterface;
use App\Mail\RecoverPasswordEmail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RecoveryPasswordController
{
    public function __construct(
        private AdminRepositoryInterface $repository,
        private Helper $helper
    ) {}

    public function create(Request $request)
    {
        // Se exisitr o e-mail
        if (isset($request->email)) {
            // Verifico se o e-mail pertence a algum administrador
            $user = Admin::where('email', $request->email)->first();
            
            if ($user) {
                try {
                    // Registro um token para o usuário
                    $token = $this->repository->randomToken($user->id);
                    // Faço a construção e envio do e-mail.
                    $content = new RecoverPasswordEmail($user, $token);
                    Mail::to('daniel.ismael@encoparts.com')->send($content);
                    // retorno
                    return $this->helper->http_response_code_200('Foi enviado um e-mail com instruções para recuperar a senha.');
                } catch (\Throwable $th) {
                    return $this->helper->http_response_code_500();
                }
            }
            
            return $this->helper->http_response_code_404('Esse e-mail não pertence a nenhum administrador.');
        }
    }

    public function verifyCode(Request $request)
    { 
        return $this->repository->verifyCode($request->code);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->repository->changePasswordForCode($request->all());
    }
}