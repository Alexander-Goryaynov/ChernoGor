<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

/**
 * @method static Role USER()
 * @method static Role ADMIN()
 */
class Role extends Enum
{
    private const USER = 'user';
    private const ADMIN = 'admin';
}
