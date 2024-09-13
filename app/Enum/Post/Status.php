<?php

namespace App\Enum\Post;

enum Status : int
{
    case DRAFT = 1;
    case NEED_REVIEW = 5;
    case SCHEDULE = 10;

    public function text()
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::NEED_REVIEW => 'Need Review',
            self::SCHEDULE => 'Schedule',
        };
    }
}
