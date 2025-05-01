<?php

namespace Src\Rule;

class DateRule implements RuleInterface
{
    public function validate(string $field, mixed $value, $constraint = null): string|bool
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return "The $field field must be a valid date in YYYY-MM-DD format.";
        }

        return true;
    }
}