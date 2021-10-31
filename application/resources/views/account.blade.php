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
            <h1 class="text-center">Moni -  Balance: £<?=number_format($account['balance'], 2);?> Credit Limit: £<?=number_format($account['credit_limit'], 2);?></h1>
            <table class="table">
                <thead>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Merchant</th>
                    <th scope="col">Category</th>
                </thead>
                <tbody>
                    <?php foreach($account['transactions'] as $transaction) : ?>
                        <tr>
                            <th scope="row"><?=DateTime::createFromFormat('Y-m-d H:i:s', $transaction['transaction_date'])->format('d/m/Y');?> </th>
                            <td><?=$transaction['is_credit'] === 0 ? '-' : '';?>£<?=number_format($transaction['value'], 2);?>
                            <td><?=$transaction['merchants']['name'];?>
                            <td><?=$transaction['merchants']['categories']['name'];?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="row">
            <a href="/" class="btn btn-primary col">Home</a>
        </div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
