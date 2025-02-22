<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): LoginResource
    {
        $validated = $request->validated();

        $user = User::query()->where('email', $validated['email'])->first();

        abort_if(
            ! $user || ! Hash::check($validated['password'], $user->password),
            Response::HTTP_UNAUTHORIZED,
            'Invalid credentials.'
        );

        $token = $user->createToken('API Token')->plainTextToken;

        return LoginResource::make([
            'token' => $token,
        ]);
    }
}
