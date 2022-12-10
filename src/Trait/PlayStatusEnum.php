<?php

namespace App\Trait;

use Adeliom\EasyCommonBundle\Helper\Enum;

/**
 * ThreeStateStatus enum.
 *
 * @method static PlayStatusEnum UPFRONT()
 * @method static PlayStatusEnum CLOSED()
 */

class PlayStatusEnum extends Enum
{
    public const UPFRONT = 'upfront';
    public const CLOSED = 'closed';
}
