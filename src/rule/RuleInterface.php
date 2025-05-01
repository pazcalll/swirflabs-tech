<?php

namespace Src\Rule;

interface RuleInterface
{
    public function validate(string $field, mixed $value = null, $constraint = null): string|bool;
}