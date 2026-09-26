<?php

namespace Infrastructure\Adapters\Hashing;

use Domain\Auth\Ports\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

class BcryptPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }
}