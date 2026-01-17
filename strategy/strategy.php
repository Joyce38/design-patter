<?php
// PaymentStrategy.php
interface PaymentStrategy
{
    public function processPayment(float $amount): bool;
}
// CreditCardPayment.php
class CreditCardPayment implements PaymentStrategy {
    public function processPayment(float $amount): string {
        // Specific credit card processing logic
        return "Processing \${$amount} payment via Credit Card.";
    }
}

// PayPalPayment.php
class PayPalPayment implements PaymentStrategy {
    public function processPayment(float $amount): string {
        // Specific PayPal processing logic
        return "Processing \${$amount} payment via PayPal.";
    }
}

// BankTransferPayment.php
class BankTransferPayment implements PaymentStrategy {
    public function processPayment(float $amount): string {
        // Specific bank transfer processing logic
        return "Processing \${$amount} payment via Bank Transfer.";
    }
}
