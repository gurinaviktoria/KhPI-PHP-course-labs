<?php
require_once 'BankAccount.php';
require_once 'SavingAccount.php';

try {
    // Звичайний рахунок
    $acc1 = new BankAccount(100, "USD");
    $acc1->deposit(50);
    $acc1->withdraw(30);
    echo "Баланс звичайного рахунку: " . $acc1->getBalance() . "<br>";

    // Накопичувальний рахунок
    $acc2 = new SavingsAccount(200, "USD");
    $acc2->applyInterest();
    echo "Баланс накопичувального рахунку після відсотків: " . $acc2->getBalance() . "<br>";

    // Перевірка помилки
    $acc1->withdraw(1000); // викличе виняток
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage();
}

