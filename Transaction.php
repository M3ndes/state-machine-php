<?php

namespace Pagarme\State\Transaction;

use Pagarme\State\StateMachine\StateMachine;

class Transaction
{
    public $identifier;
    public $stateMachine;

    public function __construct()
    {
        $this->identifier = $this->setIdentifier();
        $this->stateMachine = new StateMachine($this->identifier);
    }

    public function create(): void
    {
        $this->stateMachine->handleTransitions('create');
    }

    public function cancel(): void
    {
        $this->stateMachine->handleTransitions('cancel');
    }

    public function setIdentifier(): string
    {
        return wordwrap(uniqid(), 5, "-", true);
    }
}
