<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = User::with(
            [
                'generalAccount.transactions.merchants.categories',
                'savingsAccount.transactions.merchants.categories',
                'creditAccount.transactions.merchants.categories',
                'billAccount.transactions.merchants.categories'
            ]
        )->first();
        
        return response()
        ->view(
            'home',
            [
                'user' => $user->toArray(),
            ]
        );
    }
}
