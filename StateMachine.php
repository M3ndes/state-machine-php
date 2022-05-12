<?php

namespace Pagarme\State\StateMachine;


class StateMachine
{

    public $identifier;
    public $state;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
        $this->state = $this->setState(null);
    }

    public function handleTransitions($state): void
    {
        switch ($state) {
            case 'create':
                echo $this->validateCreateTransition() == true ? $this->createTransition() : $this->createException();
                break;
            case 'confirm':
                echo $this->validateConfirmTransition() == true ? $this->confirmTransition() : $this->confirmException();
                break;
            case 'cancel':
                echo $this->validateCancelTransition() == true ? $this->cancelTransition() : $this->cancelException();
                break;
            default:
                echo 'default';
                break;
        }
    }

    public function createTransition(): string
    {
        $this->setState('pending');
        return  "created transaction #$this->identifier \n status: $this->state";
    }

    public function createException(): string
    {
        return "a transaction only could be created if the current status is null";
    }

    public function confirmTransition(): string
    {
        $this->setState('pending');
        return  "created transaction #$this->identifier \n status: $this->state";
    }

    public function confirmException(): string
    {
        return "a transaction only could be paid if the current status is pending";
    }

    public function cancelTransition(): string
    {
        $this->setState('canceled');
        return  "created transaction #$this->identifier \n status: $this->state";
    }

    public function cancelException(): string
    {
        return "a transaction only could be cancelled if the current status is pending";
    }

    public function validateConfirmTransition(): ?string
    {
        return $this->state == 'pending' ? true : false;
    }

    public function validateCancelTransition(): ?string
    {
        return $this->state == 'pending' ? true : false;
    }

    public function validateCreateTransition(): ?string
    {
        return $this->state == null ? true : false;
    }

    public function setState($state): void
    {
        $state == null ? $this->state = null : $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }
}
