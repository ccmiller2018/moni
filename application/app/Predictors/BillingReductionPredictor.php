<?php

namespace App\Predictors;

use App\Models\BillProvider;
use App\Models\Category;
use App\Models\Merchant;

class BillingReductionPredictor
{
    private const CATEGORIES = [
        'Bills - Electricity',
        'Bills - Gas',
        'Bills - Water',
        'Bills - Internet',
        'Bills - Mobile',
        'Bills - Television',
    ];

    public static function predict(array $transactions): array
    {
        $return = [];
        foreach ($transactions as $transaction) {
            if (in_array($transaction['merchants']['categories']['name'], self::CATEGORIES)) {
                $category = Category::where('name', '=', $transaction['merchants']['categories']['name'])->first();
                $providers = BillProvider::where('category_id', '=', $category->id)->get()->toArray();
                $currentProvider = BillProvider::where('merchant_id', '=', $transaction['merchant_id'])->first();

                $averageOffset = (($currentProvider->average_bill - $transaction['value']) / $transaction['value']) *100;

                foreach ($providers as $provider) {
                    $calculatedValue = round(($provider['average_bill'] / 100) * (100 + $averageOffset), 2); 
                    if ($calculatedValue < $transaction['value']) {
                        $return[$category->name][] = ['provider' => Merchant::where('id', '=', $provider['merchant_id'])->first()->name, 'category' => $category->name, 'rate' => $calculatedValue];
                    }
                }
            }
        }

        return $return;
    }
}
