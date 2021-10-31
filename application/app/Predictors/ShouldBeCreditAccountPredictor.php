<?php

namespace App\Predictors;

class ShouldBeCreditAccountPredictor
{
    public const CATEGORIES = [
        'General',
    ];

    public static function predict(array $transactions): array
    {
        $return = [];
        
        foreach ($transactions as $transaction) {
            if ($transaction['value'] >= 100.0 && $transaction['value'] <= 30000.00 && in_array($transaction['merchants']['categories']['name'], self::CATEGORIES)) {
                $return[] = $transaction;
            }
        }

        return $return;
    }
}
