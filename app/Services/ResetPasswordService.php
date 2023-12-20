<?php
namespace App\Services;
use Illuminate\Support\Str;

class ResetPasswordService
{
    public function getResetCode(int $length = 6): int
    {
        return Str::random($length);
    }
}
