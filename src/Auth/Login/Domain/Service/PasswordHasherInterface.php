<?php
namespace App\Auth\Login\Domain\Service;

interface PasswordHasherInterface
{
    public function hashPassword(string $plainPassword): string;
}