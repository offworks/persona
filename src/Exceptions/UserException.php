<?php

namespace Persona\Exceptions;

use Exedra\Exception\Exception;

class UserException extends Exception
{
    protected $messages = [];

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}