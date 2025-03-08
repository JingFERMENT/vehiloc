<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class BannedWordsValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var Voiture $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $value = strtolower($value);

        foreach ($constraint->bannedwords as $bannedword) {
            if(str_contains($value, $bannedword)){
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ bannedword }}', $bannedword)
                    ->addViolation();
                    return ;
            }
        }
        
    }
}
