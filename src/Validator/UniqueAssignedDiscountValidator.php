<?php

namespace App\Validator;

use App\Repository\AssignedDiscountRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueAssignedDiscountValidator extends ConstraintValidator
{
    public function __construct(private AssignedDiscountRepository $assignedDiscounts) {}

    public function validate($assignedDiscount, Constraint $constraint): void
    {
        /* @var UniqueAssignedDiscount $constraint */

        if (null === $assignedDiscount->getDiscount() || null === $assignedDiscount->getUser()) {
            return;
        }

        $existing = $this->assignedDiscounts->findOneBy([
            'discount' => $assignedDiscount->getDiscount(),
            'user' => $assignedDiscount->getUser(),
        ]);

        if ($existing && $existing->getId() !== $assignedDiscount->getId()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('discount')
                ->addViolation();
        }
    }
}
