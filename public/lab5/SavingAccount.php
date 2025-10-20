<?php
require_once 'BankAccount.php';

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.05; // 5%

    public function applyInterest() {
        $this->balance += $this->balance * self::$interestRate;
    }
}

