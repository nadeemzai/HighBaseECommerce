<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(array $data): string
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            \Log::warning('Failed login attempt', ['email' => $data['email']]);
            throw ValidationException::withMessages(['email' => ['Invalid credentials.']]);
        }

        return $user->createToken('api-token')->plainTextToken;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }

    public function updateProfile(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }

    public function sendResetLink(array $data): JsonResponse
    {
        $status = Password::sendResetLink(['email' => $data['email']]);

        return response()->json(['message' => __($status)], $status === Password::RESET_LINK_SENT ? 200 : 422);
    }

    public function resetPassword(array $data): JsonResponse
    {
        $status = Password::reset(
            $data,
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
                $user->tokens()->delete();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)]);
        }

        throw ValidationException::withMessages(['email' => [__($status)]]);
    }
}
