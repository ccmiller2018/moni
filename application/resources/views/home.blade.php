<?php

use App\Calculators\SavingsCalculator;
use App\Predictors\TransactionPredictor;
use Carbon\Carbon;

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moni</title>
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div class="container">
            <h1 class="text-center">Moni - {{ $user['name'] }}</h1>
            <div class="row">
                <div class="card col">
                    <div class="card-header">General Account</div>
                    <div class="card-body">
                        <p class="card-text">Balance: £<?=number_format($user['general_account']['balance'], 2);?></p>
                        <p class="card-text">Last Transaction: <?=end($user['general_account']['transactions'])['is_credit'] === 0  ? '-' : '';?>£<?=number_format(end($user['general_account']['transactions'])['value']);?> on <?=DateTime::createFromFormat('Y-m-d H:i:s', end($user['general_account']['transactions'])['transaction_date'])->format('d/m/Y');?> (<?=end($user['general_account']['transactions'])['merchants']['name'];?>)</p>
                        <p class="card-text"><?=TransactionPredictor::predict($user['general_account']['transactions']); ?></p>
                        <a href="/account/<?=$user['general_account']['id'];?>" class="btn btn-primary">Explore General Account</a>
                    </div>
                </div>
                <div class="card col">
                    <div class="card-header">Savings Account</div>
                    <div class="card-body">
                        <p class="card-text">Balance: £<?=number_format($user['savings_account']['balance'], 2);?></p>
                        <p class="card-text">Last Transaction: <?=end($user['savings_account']['transactions'])['is_credit'] === 0  ? '-' : '';?>£<?=number_format(end($user['savings_account']['transactions'])['value']);?> on <?=DateTime::createFromFormat('Y-m-d H:i:s', end($user['savings_account']['transactions'])['transaction_date'])->format('d/m/Y');?> (<?=end($user['savings_account']['transactions'])['merchants']['name'];?>)</p>
                        <p class="card-text"><?=TransactionPredictor::predict($user['savings_account']['transactions']); ?></p>
                        <a href="/account/<?=$user['savings_account']['id'];?>" class="btn btn-primary">Explore Savings Account</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card col">
                    <div class="card-header">Bill Account</div>
                    <div class="card-body">
                        <p class="card-text">Balance: £<?=number_format($user['bill_account']['balance'], 2);?></p>
                        <p class="card-text">Last Transaction: <?=end($user['bill_account']['transactions'])['is_credit'] === 0  ? '-' : '';?>£<?=number_format(end($user['bill_account']['transactions'])['value']);?> on <?=DateTime::createFromFormat('Y-m-d H:i:s', end($user['bill_account']['transactions'])['transaction_date'])->format('d/m/Y');?> (<?=end($user['bill_account']['transactions'])['merchants']['name'];?>)</p>
                        <p class="card-text"><?=TransactionPredictor::predict($user['bill_account']['transactions']); ?></p>
                        <a href="/account/<?=$user['bill_account']['id'];?>" class="btn btn-primary">Explore Bill Account</a>
                    </div>
                </div>
                <div class="card col">
                    <div class="card-header">Credit Account</div>
                    <div class="card-body">
                        <p class="card-text">Balance: £<?=number_format($user['credit_account']['balance'], 2);?></p>
                        <p class="card-text">Last Transaction: <?=end($user['credit_account']['transactions'])['is_credit'] === 0  ? '-' : '';?>£<?=number_format(end($user['credit_account']['transactions'])['value']);?> on <?=DateTime::createFromFormat('Y-m-d H:i:s', end($user['credit_account']['transactions'])['transaction_date'])->format('d/m/Y');?> (<?=end($user['credit_account']['transactions'])['merchants']['name'];?>)</p>
                        <p class="card-text"><?=TransactionPredictor::predict($user['credit_account']['transactions']); ?></p>
                        <a href="/account/<?=$user['credit_account']['id'];?>" class="btn btn-primary">Explore Credit Account</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card col">
                    <div class="card-header">Expected Worth On Your 65th Birthday</div>
                    <div class="card-body">
                        <?php
                            $balance = $user['savings_account']['balance'];
                            $expectedPayments =  SavingsCalculator::calculateSavings(
                                $user['savings_account']['transactions'][0]['value'],
                                Carbon::createFromFormat('Y-m-d', $user['date_of_birth'])
                            );
                            $months = Carbon::now()->diffInMonths(
                                Carbon::createFromFormat('Y-m-d', $user['date_of_birth'])->addYears(65)
                            );
                            $expectedInterest = SavingsCalculator::calculateInterest($user['savings_account']['transactions'][0]['value'], $months, $balance);
                        ?>
                        <p class="card-text">Your Current Balance: £<?=number_format($balance); ?></p>
                        <p class="card-text">Expected Payments: £<?=number_format($expectedPayments, 2);?></p>
                        <p class="card-text">Expected Interest: £<?=number_format($expectedInterest, 2); ?>
                        <p class="card-text">Expected Total Value: £<?=number_format(($balance + $expectedInterest + $expectedPayments), 2); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="/manager/<?=$user['id'];?>" class="btn btn-primary col">Moni Manager</a>
            </div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
