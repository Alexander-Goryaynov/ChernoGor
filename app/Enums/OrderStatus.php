<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

/**
 * @method static OrderStatus PROCESSING()
 * @method static OrderStatus CANCELED()
 * @method static OrderStatus FINISHED()
 */
class OrderStatus extends Enum
{
    private const PROCESSING = 'processing';
    private const CANCELED = 'canceled';
    private const FINISHED = 'finished';
}
