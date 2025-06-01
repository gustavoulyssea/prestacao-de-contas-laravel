<?php

declare(strict_types=1);

namespace App\Models\Mail;

use App\Mail\PasswordResetLink;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ResetPasswordEmail
{
    public static function send(string $email): void
    {
        if ($customer = User::query()->where(User::EMAIL, '=', $email)->first()) {
            $hash = md5(uniqid() . rand(1000000, 9999999));
            $customer->{User::RESET_PASSWORD_TOKEN} = $hash;
            $customer->save();

            Mail::to($customer->email)->send(new PasswordResetLink([
                'reset_hash' => $hash
            ]));
        } else {
            // Simulate email processing time
            sleep(3);
        }
    }

}
