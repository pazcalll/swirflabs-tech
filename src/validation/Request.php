<?php

namespace Src\Validation;

use Src\Rule\RuleInterface;

class Request
{
    protected function validateRules(array $data, array $rules): void
    {
        $errors = [];
        $message = null;
        $messageCount = 0;

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;

            foreach ($fieldRules as $rule => $constraint) {
                if (is_int($rule)) {
                    $rule = $constraint;
                    $constraint = null;
                }

                $ruleClass = $this->getRuleClass($rule);

                if (!$ruleClass instanceof RuleInterface) {
                    throw new \InvalidArgumentException("Invalid rule: $rule");
                }

                $result = $ruleClass->validate($field, $value, $constraint);

                if ($result !== true) {
                    $errors[$field][] = $result;
                    $messageCount++;
                    if (!$message) $message = $result;
                    if ($messageCount === 2) {
                        $message = $message . " And more errors occurred.";
                        $messageCount++;
                    }
                }
            }
        }

        if (!empty($errors)) $_SESSION['errors'] = $errors;
        if ($message) throw new \InvalidArgumentException($message);
    }


    protected function getRuleClass(string $rule): RuleInterface
    {
        $className = "Src\\Rule\\" . ucfirst($rule) . "Rule";

        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Validation rule class $className does not exist.");
        }

        return new $className();
    }
}