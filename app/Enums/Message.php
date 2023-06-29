<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Message extends Enum
{
    const CREATED = "Created Successfully.";
    const UPDATED = 'Updated Successfully.';
    const FAILED = 'Failed to perform this task.';
    const DELETED = "Record deleted successfully.";
    const DOWNLOADED = "File downloaded sucessfully";
    const NOT_FOUND = "Record not found.";
    const SERVICE_DOWN = 'Service down.Please try again later.';
    const QUERY_EXCEPTION = "Make sure you have filled data correctly.";
    const UN_AUTHORIZED = "You are unauthorized to perform this task.";
}
