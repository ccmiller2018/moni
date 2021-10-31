<?php

namespace App\Calculators;

use Carbon\Carbon;

class SavingsCalculator
{
    private const INTEREST_RATE = 3.5;

    public static function calculateSavings(float $value, Carbon $birthDate): float
    {
            $now = Carbon::now();

            $numberOfTransactions = $now->diffInMonths($birthDate->addYears(65));

            return $value * $numberOfTransactions;
    }

    public static function calculateInterest(float $contribution, int $numberOfContributions, float $initialBalance): float
    {
        $numberOfContributions = $numberOfContributions / 12;
        return $contribution * ((1 + self::INTEREST_RATE / $numberOfContributions ^ ($numberOfContributions / 12 * $numberOfContributions - 1) / (self::INTEREST_RATE / $numberOfContributions)));
    }
}
