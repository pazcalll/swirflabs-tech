<?php

namespace Src\Rule;

interface RuleInterface
{
    public function validate(string $field, mixed $value, $constraint = null): string|bool;
}