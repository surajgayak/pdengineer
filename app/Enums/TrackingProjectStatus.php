<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TrackingProjectStatus extends Enum
{
    const NOT_STARTED = 0;
    const STARTED = 1;
    const COMPLETED = 2;

    public static function getAllTrackingProjectStatus()
    {
        return [
            'Not Started' => self::NOT_STARTED,
            'Started' => self::STARTED,
            'Completed' => self::COMPLETED
        ];
    }
}
