<?php

namespace App;

class FlashMessages
{
    private array $messages;

    public function hasMessages(): bool
    {
        if (is_null($this->messages)) {
            return false;
        }
        return true;
    }

    public function getMessages(): array
    {
        $messages = $this->messages;
        $this->messages = [];
        return $messages;
    }

    public function addMessage(string $message, string $type)
    {
        $this->messages[] = $type -> $message;
    }
}