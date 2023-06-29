<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TrackingStatus extends Enum
{
    //Tracking Bank guarantee & retention money
    const EXPIRED = 0;
    const REFUNDED = 1;
    const ACTIVE = 2;

    public static function getAllTrackingStatus()
    {
        return [
            'ACTIVE' => self::ACTIVE,
            'EXPIRED TO BE REFUNDED' => self::EXPIRED,
            'REFUNDED' => self::REFUNDED,
        ];
    }
}
