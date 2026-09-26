<?php

namespace Domain\Auth\Ports;

interface PasswordHasherInterface
{
    public function hash(string $plainPassword): string;
    public function verify(string $plainPassword, string $hashedPassword): bool;
}