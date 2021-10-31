<?php

namespace App\Predictors;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class BillingPredictor
{
    public static function predict(array $transactions): float
    {
        $startOfNextMonth = Carbon::now()->addMonthsNoOverflow(1)->startOfMonth();

        $prediction = TransactionPredictor::predict($transactions);
        
        preg_match_all('/\d{2}\/\d{2}\/\d{4}/', $prediction, $matches);
        
        $predictedDate = Carbon::createFromFormat('d/m/Y', $matches[0][0]);
        
        if ($predictedDate->gte($startOfNextMonth)) {
            $account = Account::where('id', '=', $transactions[0]['account_id'])->first();
            return $account->balance;
        }
        
        return 0;
    } 
}
