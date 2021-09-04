<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

/**
 * @method static HourState ACTIVE()
 * @method static HourState INACTIVE()
 * @method static HourState FORCE_ACTIVE()
 */
class HourState extends Enum
{
    private const ACTIVE = 1;
    private const INACTIVE = 0;
    // When notary already has non-cancelled orders on this hour
    private const FORCE_ACTIVE = -1;
}
