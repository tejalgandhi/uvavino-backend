<?php

namespace App\Enums;


enum AuctionType: int
{

case Live = 1;
case TimeBased = 2;

    public static function getValues(): array
{
    return array_combine(array_column(AuctionType::cases(), 'value'), array_column(AuctionType::cases(), 'name'));;

}

}


