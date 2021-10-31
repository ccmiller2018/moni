<?php

use App\Predictors\TransactionPredictor;
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
            <h1 class="text-center">Moni Manager - {{ $user['name'] }}</h1>
        </div>
        <div class="row">
            <div class="card col">
                <div class="card-header">Savings Advice</div>
                    <div class="card-body">
                        <?php 
                            if ($savingsAdjustment === 0) {
                                $message = 'Your savings are absolutely on track! I can not see any changes needed';
                            } else if ($savingsAdjustment > 0) {
                                $message = 'Great news! based on your previous spending, we can see you can save more.';
                            } else {
                                $message = 'Uh Oh! based on your previous spending, you need to reduce your savings, or your spending.';
                            }
                        ?>
                        <p class="card-text"><?=$message;?></p>
                        <p class="card-text">Adjustment: £<?=$savingsAdjustment < 0 ? '-' : '';?><?=number_format($savingsAdjustment, 2);?></p>
                    <a href="#" class="btn btn-primary">Adjust Savings</a>
                </div>
            </div>
            <div class="card col">
                <div class="card-header">Bills Advice</div>
                    <div class="card-body">
                        <?php 
                            if ($billAdjustment === 0) {
                                $message = 'Your bills are absolutely on track! I can not see any changes needed';
                            } else if ($billAdjustment > 0) {
                                $message = 'Great news! based on your previous spending, we can see you can reduce your bill outlay.';
                            } else {
                                $message = 'Uh Oh! based on your previous spending, you need to increase your billing outlay';
                            }
                        ?>
                        <p class="card-text"><?=$message;?></p>
                        <p class="card-text">Adjustment: £<?=$billAdjustment > 0 ? '-' : '';?><?=number_format($billAdjustment, 2);?></p>
                    <a href="#" class="btn btn-primary">Adjust Billing</a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if (count($shouldBeCredit) > 0) : ?>
                <div class="card col">
                    <div class="card-header">Transactions You Can Get Protection For</div>
                    <div class="card-body">
                        <?php foreach($shouldBeCredit as $transaction) : ?>
                            <p class="card-text"><?=$transaction['is_credit'] === 0  ? '-' : '';?>£<?=number_format($transaction['value']);?> on <?=DateTime::createFromFormat('Y-m-d H:i:s', $transaction['transaction_date'])->format('d/m/Y');?> (<?=$transaction['merchants']['name'];?>)</p>
                        <?php endforeach;?>
                        <a href="#" class="btn btn-primary">Protect Me</a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (count($shouldNotBeCredit) > 0) : ?>
                <div class="card col">
                    <div class="card-header">Transactions You Should Spend From General</div>
                    <div class="card-body">
                        <?php foreach($shouldNotBeCredit as $transaction) : ?>
                            <p class="card-text"><?=$transaction['is_credit'] === 0  ? '-' : '';?>£<?=number_format($transaction['value']);?> on <?=DateTime::createFromFormat('Y-m-d H:i:s', $transaction['transaction_date'])->format('d/m/Y');?> (<?=$transaction['merchants']['name'];?>)</p>
                        <?php endforeach;?>
                        <a href="#" class="btn btn-primary">Pay It Off</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php foreach($newBillProvider as $category => $options) : ?>
                <div class="card col">
                    <div class="card-header">NEW BILL OPTIONS: <?=$category;?></div>
                    <div class="card-body">
                        <?php foreach($options as $option) : ?>
                            <p class="card-text"><?= $option['provider']; ?> at £<?=$option['rate']; ?></p>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <a href="/" class="btn btn-primary col">Home</a>
        </div>
    </div>
        <script src="/js/app.js"></script>
    </body>
</html>
