<?php

namespace Src\Rule;

class WithinRule implements RuleInterface
{
    public function validate(string $field, mixed $value, $constraint = null): string|bool
    {
        if (!is_array($constraint)) {
            return "The constraint must be an array.";
        }

        if (!in_array($value, $constraint)) {
            return "The $field field must be one of the following values: " . implode(", ", $constraint) . ".";
        }

        return true;
    }
}