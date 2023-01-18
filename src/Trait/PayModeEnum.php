<?php

namespace App\Trait;

use Adeliom\EasyCommonBundle\Helper\Enum;

/**
 * PayModeEnum enum.
 *
 * @method static PayModeEnum CB()
 * @method static PayModeEnum CHEQUE()
 * @method static PayModeEnum CASH()
 * @method static PayModeEnum ONLINE()
 * @method static PayModeEnum TRANSFER()
 */

class PayModeEnum extends Enum
{
    public const CB = 'CB';
    public const CHEQUE = 'Chèque';
    public const CASH = 'Espèces';
    public const ONLINE = 'Internet';
    public const TRANFER = 'Virement';
}
