<?php

namespace Src\Component\Php;

class Alert
{
    private string $type;
    private string $message;

    final public const TYPE_SUCCESS = 'success';
    final public const TYPE_ERROR = 'error';
    final public const TYPES = [
        self::TYPE_SUCCESS,
        self::TYPE_ERROR,
    ];

    public function __construct($type, $message)
    {
        $this->type = in_array($type, self::TYPES) ? $type : self::TYPE_ERROR;
        $this->message = $message;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        if (in_array($type, self::TYPES)) {
            $this->type = $type;
        } else {
            throw new \InvalidArgumentException("Invalid alert type: $type");
        }
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function render(): string
    {
        return sprintf('<div class="alert alert-%s">%s</div>', $this->type, $this->message);
    }
}