<?php

namespace App\Predictors;

use App\Models\Account;
use Carbon\Carbon;

class SavingPredictor
{
    public static function predict(array $generalTransactions, array $savingsTransactions): float
    {
        $generalPrediction = TransactionPredictor::predict($generalTransactions);
        preg_match_all('/\d{2}\/\d{2}\/\d{4}/', $generalPrediction, $generalMatches);
        $generalPredictedDate = Carbon::createFromFormat('d/m/Y', $generalMatches[0][0]);

        $savingsPrediction = TransactionPredictor::predict($savingsTransactions);
        preg_match_all('/\d{2}\/\d{2}\/\d{4}/', $savingsPrediction, $savingsMatches);
        $savingsPredictedDate = Carbon::createFromFormat('d/m/Y', $savingsMatches[0][0]);

        $startOfNextMonth = Carbon::now()->addMonthsNoOverflow(1)->startOfMonth();

        if ($generalPredictedDate->gte($startOfNextMonth) && $savingsPredictedDate->gte($startOfNextMonth)) {
            $account = Account::where('id', '=', $generalTransactions[0]['account_id'])->first();

            return $account->balance / 2;
        }

        return 0;
    }
}
