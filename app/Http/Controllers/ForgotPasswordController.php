<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Especialista;
use App\Models\Paciente;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni' => 'required|string|exists:users,dni',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $user = User::where('dni', $request->dni)->first();
        $token = Str::uuid();

        Token::create([
            'token' => $token,
            'token_type' => 'reset_password',
            'revoked' => false,
            'expired' => false,
            'expires_at' => Carbon::now()->addMinutes(5),
            'user_id' => $user->id,
        ]);

        $userData = $this->getUserDataByRole($user);

        Mail::send(
            'emails.password_reset',
            ['token' => $token, 'user' => $userData],
            function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Password Reset Request');
            }
        );

        return response()->json(['message' => 'Password reset link sent to your email.']);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|exists:tokens,token',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $passwordReset = Token::where('token', $request->token)->first();
        if (!$passwordReset) return response()->json(['message' => 'Invalid token.'], 400);

        if (
            $passwordReset->revoked || $passwordReset->expired ||
            $passwordReset->expires_at->isPast()
        ) {
            $passwordReset->update(['revoked' => true, 'expired' => true]);
            return response()->json(['message' => 'Token has expired or is invalid.'], 400);
        }

        $user = User::find($passwordReset->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        $passwordReset->delete();

        return response()->json(['message' => 'Password has been reset.']);
    }

    private function getUserDataByRole($user)
    {
        switch ($user->rol) {
            case 'especialista':
                return Especialista::where('user_id', $user->id)->first();
            case 'admin':
                return Administrador::where('user_id', $user->id)->first();
            case 'paciente':
                return Paciente::where('user_id', $user->id)->first();
            default:
                return null;
        }
    }
}
