<?php

namespace Src\Rule;

class LengthMaxRule implements RuleInterface
{
    public function validate(string $field, mixed $value, $constraint = null): string|bool
    {
        if (strlen($value) > $constraint) {
            return "The $field field must not exceed $constraint characters.";
        }

        return true;
    }
}