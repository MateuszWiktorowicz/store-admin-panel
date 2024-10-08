<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class UniqueAssignedDiscount extends Constraint
{
    public $message = 'This discount group is already assigned to Customer.';

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
