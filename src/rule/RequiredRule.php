<?php

namespace Src\Rule;

class RequiredRule implements RuleInterface
{
    public function validate(string $field, mixed $value, $constraint = null): string|bool
    {
        if (empty($value)) {
            return "This $field field is required.";
        }

        return true;
    }
}