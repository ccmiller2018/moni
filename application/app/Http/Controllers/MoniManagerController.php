<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Predictors\ShouldBeCreditAccountPredictor;
use App\Predictors\ShouldNotBeCreditAccountPredictor;
use App\Predictors\BillingPredictor;
use App\Predictors\BillingReductionPredictor;
use App\Predictors\SavingPredictor;

class MoniManagerController extends Controller
{
    public function __invoke(int $id)
    {
        $user = User::with(
            [
                'generalAccount.transactions.merchants.categories',
                'savingsAccount.transactions.merchants.categories',
                'creditAccount.transactions.merchants.categories',
                'billAccount.transactions.merchants.categories'
            ]
        )
            ->first()
            ->toArray();
        
        $shouldBeCredit = ShouldBeCreditAccountPredictor::predict($user['general_account']['transactions']);
        $shouldNotBeCredit = ShouldNotBeCreditAccountPredictor::predict($user['credit_account']['transactions']);
        $billAdjustment = BillingPredictor::predict($user['bill_account']['transactions']);
        $savingsAdjustment = SavingPredictor::predict($user['general_account']['transactions'], $user['savings_account']['transactions']);
        $newBillProvider = BillingReductionPredictor::predict($user['bill_account']['transactions']);
        
        return response()
            ->view(
                'moniManager',
                [
                    'user' => $user,
                    'shouldBeCredit' => $shouldBeCredit,
                    'shouldNotBeCredit' => $shouldNotBeCredit,
                    'billAdjustment' => $billAdjustment,
                    'savingsAdjustment' => $savingsAdjustment,
                    'newBillProvider' => $newBillProvider,
                ]
            );
    }
}