<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderType extends Enum
{
    const MALE = 0;
    const FEMALE = 1;
    const OTHERS = 2;

    public static function getAllGenderType()
    {
        return [
            'Male' => self::MALE,
            'Female' => self::FEMALE,
            'Others' => self::OTHERS
        ];
    }
}
