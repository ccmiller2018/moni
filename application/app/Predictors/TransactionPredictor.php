<?php

namespace App\Predictors;

use Carbon\Carbon;

class TransactionPredictor
{
    public static function predict(array $transactions): string
    {
        $date = Carbon::now();
        foreach ($transactions as $transaction) {
            $transactionDate = Carbon::createFromTimeString($transaction['transaction_date']);
            $newDate = $transactionDate->addMonthNoOverflow(1);
            if ($newDate->gte($date)) {
                return 'Next Expected: ' . ($transaction['is_credit'] === 0 ? '-' : '') . '£' . number_format($transaction['value'], 2) . ' on ' . $newDate->format('d/m/Y') . '(' . $transaction['merchants']['name'] . ')';
            }
        }
        return '';
    }
}
