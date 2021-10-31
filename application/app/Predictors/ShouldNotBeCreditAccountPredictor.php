<?php

namespace App\Predictors;

class ShouldNotBeCreditAccountPredictor
{
    public const CATEGORIES = [
        'Eating Out',
        'Groceries',
        'Bills',
        'Personal Care',
        'Entertainment',
        'Transport',
        'Debt',
    ];

    public static function predict(array $transactions): array
    {
        $return = [];

        foreach ($transactions as $transaction) {
            if ($transaction['value'] <= 100.0 || in_array($transaction['merchants']['categories']['name'], self::CATEGORIES)) {
                $return[] = $transaction;
            }
        }
        return $return;
    }
}