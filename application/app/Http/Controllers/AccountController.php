<?php

namespace App\Http\Controllers;

use App\Models\Account;

class AccountController
{
    public function __invoke(int $accountId)
    {
        $account = Account::with('transactions.merchants.categories')->where('id', '=', $accountId)->first()->toArray();

        return response()->view('account', ['account' => $account]);
    }
}