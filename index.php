<?php
use Pagarme\State\Transaction\Transaction;
require_once __DIR__ . '/config/autoload.php';


$transaction = new Transaction();
$transaction->create();
$transaction->cancel();
