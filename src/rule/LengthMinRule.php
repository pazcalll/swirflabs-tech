<?php

namespace Src\Rule;

class LengthMinRule implements RuleInterface
{
    public function validate(string $field, mixed $value = null, $constraint = null): string|bool
    {
        if (strlen($value ?? '') < $constraint) {
            return "The $field field must be at least $constraint characters long.";
        }

        return true;
    }
}