<?php

namespace App\Trait;

use Adeliom\EasyCommonBundle\Helper\Enum;

/**
 * ThreeStateStatus enum.
 *
 * @method static ObjectStateEnum ENABLED()
 * @method static ObjectStateEnum DISABLED()
 * @method static ObjectStateEnum PENDING()
 */

class ObjectStateEnum extends Enum
{
    public const ENABLED = 'enabled';
    public const DISABLED = 'disabled';
    public const PENDING = 'pending';

    public static function values(): array
    {
        $values = [];

        /** @psalm-var T $value */
        foreach (static::toArray() as $key => $value) {
            $values['easy.enum.state.'.$value] = $value;
        }

        return $values;
    }

}
