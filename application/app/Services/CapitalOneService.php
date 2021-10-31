<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class CapitalOneService
{
    private string $jwt;
    private string $baseUrl;

    public function __construct()
    {
        $this->jwt = Config::get('capitalOne.token');
        $this->baseUrl = Config::get('capitalOne.url');
    }

    public function getJwt(): string
    {
        return $this->jwt;
    }

    public function getUrl(): string
    {
        return $this->baseUrl;
    }

    public function createAccountSet(): array
    {
        $fullUrl = $this->getUrl() . 'accounts/create';

        $accounts = [];
        $creditAccount = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'version' => '1.0',
                'Content-Type' => 'application/json',
            ]
        )
            ->post(
                $fullUrl,
                [
                    'accounts' => [
                        [
                            'productType' => 'Credit',
                            'balance' => '0',
                            'creditLimit' => '500',
                            'state' => 'open',
                            'numTransactions' => 25,
                            'currencyCode' => 'GBP',
                        ]
                    ]
                ]
            ) ;
        
        dd($creditAccount->body());
        $accounts['credit_account'] = json_decode($creditAccount->body(), true)['Accounts'][0]['accountId'];
        
        $savingsAccount = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'version' => '1.0',
                'Content-Type' => 'application/json',
            ]
        )
        ->post(
            $fullUrl,
            [
                'accounts' => [
                    [
                        'productType' => 'Debit',
                        'balance' => 0,
                        'creditLimit' => 0,
                        'state' => 'open',
                        'numTransactions' => 25,
                        'currencyCode' => 'GBP',
                    ]
                ]
            ]
        ) ;
        
        $accounts['savings_account'] = json_decode($savingsAccount->body(), true)['Accounts'][0]['accountId'];

        $currentAccount = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'version' => '1.0',
                'Content-Type' => 'application/json',
            ]
        )->post(
            $fullUrl,
            [
                'accounts' => [
                    [
                        'productType' => 'Debit',
                        'balance' => 0,
                        'creditLimit' => 0,
                        'state' => 'open',
                        'numTransactions' => 25,
                        'currencyCode' => 'GBP',
                    ]
                ]
            ]
        ) ;

        $accounts['general_account'] = json_decode($currentAccount->body(), true)['Accounts'][0]['accountId'];
        
        $billAccount = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'version' => '1.0',
                'Content-Type' => 'application/json',
            ]
        )->post(
            $fullUrl,
            [
                'accounts' => [
                    [
                        'productType' => 'Debit',
                        'balance' => 0,
                        'creditLimit' => 0,
                        'state' => 'open',
                        'numTransactions' => 25,
                        'currencyCode' => 'GBP',
                    ]
                ]
            ]
        ) ;

        $accounts['bill_account'] = json_decode($billAccount->body(), true)['Accounts'][0]['accountId'];

        return $accounts;
    }

    public function createTransactionForAccount()
    {

    }

    public function getTransactionsForAccount(string $accountNumber)
    {
        $fullUrl = $this->getUrl() . 'transactions/accounts/' . $accountNumber . '/transactions';

        $transactions = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'version' => '1.0',
                'Content-Type' => 'application/json',
            ]
        )->get($fullUrl);
        
        dd($transactions);
    }

    public function getIndividualTransaction()
    {

    }
}
