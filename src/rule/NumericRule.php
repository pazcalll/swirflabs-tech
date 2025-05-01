<?php

namespace Src\Rule;

class NumericRule implements RuleInterface
{
    public function validate(string $field, mixed $value, $constraint = null): string|bool
    {
        if (!is_numeric($value)) {
            return "The $field field must be numeric.";
        }

        return true;
    }
}