<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ClientPartnerType extends Enum
{
    const CLIENT = 1;
    const PARTNER = 2;


    public static function getAllClientPartnerType()
    {
        return [
            'Client' => self::CLIENT,
            'Partner / Collaboration' => self::PARTNER
        ];
    }
}
