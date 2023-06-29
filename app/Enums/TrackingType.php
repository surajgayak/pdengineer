<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TrackingType extends Enum
{
    const BB = 0;
    const PB = 1;
    const RETENTION = 2;
    const CUSTOM_MARGIN = 3;


    public static function getAllTrackingType()
    {
        return [
            'BB' => self::BB,
            'PB' => self::PB,
            'Retention' => self::RETENTION,
            'Custom Margin' => self::CUSTOM_MARGIN
        ];
    }
}
