<?php

namespace App\Traits;

use DateTimeInterface;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

trait CustomHasApiTokens
{
    public function createToken(string $name, array $abilities = ['*'], ?DateTimeInterface $expiresAt = null)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = bin2hex(random_bytes(40))),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $plainTextToken);
    }
}
