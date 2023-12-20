<?php
namespace App\Services;
use App\Models\ResetPassword;
use Illuminate\Support\Str;

class ResetPasswordService
{
    public function getResetCode(int $length = 6): string
    {
        return Str::random($length);
    }
    public function saveResetCode(string $email, string $code): void
    {
        ResetPassword::create([
            'email' => $email,
            'code' => $code,
        ]);
    }
}
