<?php

namespace App\Enum\User;

enum Role : int
{
    case USER = 1;
    case ADMIN = 5;

    public function text()
    {
        return match( $this )
        {
            self::USER => 'User',
            self::ADMIN => 'Admin',
        };
    }
}
