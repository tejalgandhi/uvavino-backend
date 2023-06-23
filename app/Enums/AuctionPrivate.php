<?php

namespace App\Enums;


enum AuctionPrivate: int
{

    case Timebased = 1;
    case Live = 2;
    public static function getValues(): array
    {
        return array_combine(array_column(AuctionPrivate::cases(), 'value'), array_column(AuctionPrivate::cases(), 'name'));;

    }
}


