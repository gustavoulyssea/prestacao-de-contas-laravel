<?php

namespace App\Models\Mail;

use App\Mail\EmailConfirmationLink;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ConfirmationEmail
{
    public static function send(int $customerId): void
    {
        $customer = User::query()->where('id', '=', $customerId)->first();
        if (!$hash = $customer->email_confirmation_hash) {
            $hash = md5(uniqid().rand(1000000, 9999999));
            $customer->email_confirmation_hash = $hash;
            $customer->save();
        }

        Mail::to($customer->email)->send(new EmailConfirmationLink([
            'name' => $customer->name,
            'confirm_hash' => $hash
        ]));
    }

}
