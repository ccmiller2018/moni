<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\BillProvider;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Services\CapitalOneService;

class DatabaseSeeder extends Seeder
{
    private const CATEGORIES = [
        'Eating Out',
        'Groceries',
        'General',
        'Bills - Electricity',
        'Bills - Gas',
        'Bills - Water',
        'Bills - Internet',
        'Bills - Mobile',
        'Bills - Television',
        'Bills - General',
        'Personal Care',
        'Entertainment',
        'Transport',
        'Debt',
        'Income',
        'Internal',
    ];

    private const MERCHANTS = [
        'HTM Cafe' => 'Eating Out',
        'HTM Supermaket' => 'Groceries',
        'HTM General Stores' => 'General',
        
        'HTM Electricity Services' => 'Bills - Electricity',
        'HTM Gas Services' => 'Bills - Gas',
        'HTM Water Services' => 'Bills - Water',
        'HTM Internet Services' => 'Bills - Internet',
        'HTM Mobile Services' => 'Bills - Mobile',
        'HTM Television Services' => 'Bills - Television',
        'HTM General Services' => 'Bills - General',
        
        'Expensive Electricity Services' => 'Bills - Electricity',
        'Expensive Gas Services' => 'Bills - Gas',
        'Expensive Water Services' => 'Bills - Water',
        'Expensive Internet Services' => 'Bills - Internet',
        'Expensive Mobile Services' => 'Bills - Mobile',
        'Expensive Television Services' => 'Bills - Television',
        'Expensive General Services' => 'Bills - General',
        
        'Average Electricity Services' => 'Bills - Electricity',
        'Average Gas Services' => 'Bills - Gas',
        'Average Water Services' => 'Bills - Water',
        'Average Internet Services' => 'Bills - Internet',
        'Average Mobile Services' => 'Bills - Mobile',
        'Average Television Services' => 'Bills - Television',
        'Average General Services' => 'Bills - General',
        
        'Cheap Electricity Services' => 'Bills - Electricity',
        'Cheap Gas Services' => 'Bills - Gas',
        'Cheap Water Services' => 'Bills - Water',
        'Cheap Internet Services' => 'Bills - Internet',
        'Cheap Mobile Services' => 'Bills - Mobile',
        'Cheap Television Services' => 'Bills - Television',
        'Cheap General Services' => 'Bills - General',

        'Awful Electricity Services' => 'Bills - Electricity',
        'Awful Gas Services' => 'Bills - Gas',
        'Awful Water Services' => 'Bills - Water',
        'Awful Internet Services' => 'Bills - Internet',
        'Awful Mobile Services' => 'Bills - Mobile',
        'Awful Television Services' => 'Bills - Television',
        'Awful General Services' => 'Bills - General',
        
        'HTM Health Care' => 'Personal Care',
        'HTM Cinema' => 'Entertainment',
        'HTM Debt Collectors' => 'Debt',
        'HTM Web Development' => 'Income',
        'Internal Transfer To Savings' => 'Internal',
        'Internal Transfer To Bills' => 'Internal',
        'Internal Transfer From General' => 'Internal',
    ];

    private const BILL_PROVIDERS = [
        'HTM Electricity Services' => 32.27,
        'HTM Gas Services' => 31.96,
        'HTM Water Services' => 23.47,
        'HTM Internet Services' => 49.32,
        'HTM Mobile Services' => 51.95,
        'HTM Television Services' => 79.99,

        'Expensive Electricity Services' => 42.27,
        'Expensive Gas Services' => 41.96,
        'Expensive Water Services' => 33.47,
        'Expensive Internet Services' => 59.32,
        'Expensive Mobile Services' =>61.95,
        'Expensive Television Services' => 89.99,
        
        'Average Electricity Services' => 29.97,
        'Average Gas Services' => 27.43,
        'Average Water Services' => 21.99,
        'Average Internet Services' => 45.21,
        'Average Mobile Services' => 47.95,
        'Average Television Services' => 59.99,
        
        'Cheap Electricity Services' => 32.99,
        'Cheap Gas Services' => 21.99,
        'Cheap Water Services' => 9.99,
        'Cheap Internet Services' => 49.96,
        'Cheap Mobile Services' => 51.99,
        'Cheap Television Services' => 29.99,

        'Awful Electricity Services' => 69.99,
        'Awful Gas Services' => 69.99,
        'Awful Water Services' => 69.99,
        'Awful Internet Services' => 69.99,
        'Awful Mobile Services' => 69.99,
        'Awful Television Services' => 69.99,
    ];

    private const CREDIT_TRANSACTIONS = [
        [
            'merchant' => 'HTM General Stores',
            'value' => 105.00,
            'date' => '2021-10-29 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM General Stores',
            'value' => 25.00,
            'date' => '2021-10-14 00:00:00',
            'is_credit' => false,
        ],
    ];
    
    private const SAVINGS_TRANSACTIONS = [
        [
            'merchant' => 'Internal Transfer From General',
            'value' => 300.00,
            'date' => '2021-10-01 00:00:00',
            'is_credit' => true,
        ]
    ];
    
    private const GENERAL_TRANSACTIONS = [
        [
            'merchant' => 'HTM Web Development',
            'value' => 3000.00,
            'date' => '2021-10-01 00:00:00',
            'is_credit' => true,
        ],
        [
            'merchant' => 'Internal Transfer To Savings',
            'value' => 300.00,
            'date' => '2021-10-01 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'Internal Transfer To Bills',
            'value' => 1250.00,
            'date' => '2021-10-01 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM General Stores',
            'value' => 100.00,
            'date' => '2021-10-12 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM General Stores',
            'value' => 25.00,
            'date' => '2021-10-12 00:00:00',
            'is_credit' => false,
        ],
    ];
    
    private const BILL_TRANSACTIONS = [
        [
            'merchant' => 'Internal Transfer From General',
            'value' => 1250.00,
            'date' => '2021-10-01 00:00:00',
            'is_credit' => true,
        ],
        [
            'merchant' => 'HTM General Services',
            'value' => 750.00,
            'date' => '2021-10-03 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM Television Services',
            'value' => 125.00,
            'date' => '2021-10-03 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM Electricity Services',
            'value' => 50.00,
            'date' => '2021-10-03 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM Gas Services',
            'value' => 50.00,
            'date' => '2021-10-03 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM Water Services',
            'value' => 35.00,
            'date' => '2021-10-07 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM Mobile Services',
            'value' => 50.00,
            'date' => '2021-10-07 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM General Services',
            'value' => 10.00,
            'date' => '2021-10-10 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM Internet Services',
            'value' => 75.00,
            'date' => '2021-10-12 00:00:00',
            'is_credit' => false,
        ],
        [
            'merchant' => 'HTM General Services',
            'value' => 75.00,
            'date' => '2021-10-28 00:00:00',
            'is_credit' => false,
        ],
    ];
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(
            [
                'name' => 'Christopher Miller',
                'email' => 'ccmiller2018@gmail.com',
                'mobile_number' => '+447763044658',
                'date_of_birth' => '1981-09-01',
            ]
        );

        // $this->withCapitalOne($user);
        $this->withoutCapitalOne($user);
    }

    public function withoutCapitalOne(User $user)
    {
            $savingsAccount = new Account(['balance' => 0, 'credit_limit' => 0]);
            $billAccount = new Account(['balance' => 0, 'credit_limit' => 0]);
            $generalAccount = new Account(['balance' => 0, 'credit_limit' => 0]);
            $creditAccount = new Account(['balance' => 0, 'credit_limit' => 500]);

            $savingsAccount->save();
            $billAccount->save();
            $generalAccount->save();
            $creditAccount->save();

            $user->credit_account_id = $creditAccount->id;
            $user->savings_account_id = $savingsAccount->id;
            $user->general_account_id = $generalAccount->id;
            $user->bill_account_id = $billAccount->id;

            $user->save();

            foreach (self::CATEGORIES as $categoryName) {
                $category = new Category();
                $category->name = $categoryName;
                $category->save();
            }

            foreach (self::MERCHANTS as $merchantName => $categoryName) {
                $category = Category::where('name', '=', $categoryName)->first();
                $merchant = new Merchant(['name' => $merchantName, 'category_id' => $category->id]);
                $merchant->save();
            }

            foreach (self::BILL_PROVIDERS as $merchantName => $value) {
                $merchant = Merchant::where('name', '=', $merchantName)->first();

                $billProvider = new BillProvider(
                    [
                        'merchant_id' => $merchant->id,
                         'category_id' => $merchant->category_id,
                         'average_bill' => $value,
                    ]
                );

                $billProvider->save();
            }

            foreach (self::GENERAL_TRANSACTIONS as $transactionData) {
                $merchant = Merchant::where('name', '=', $transactionData['merchant'])->first();
                $transaction = new Transaction(['merchant_id' => $merchant->id]);
                $transaction->transaction_date = $transactionData['date'];
                $transaction->value = $transactionData['value'];
                $transaction->account_id = $user->general_account_id;
                $transaction->is_credit = $transactionData['is_credit'];

                $transaction->save();
                $account = Account::where('id', '=', $transaction->account_id)->first();

                if ($transactionData['is_credit']) {
                    $account->balance += $transactionData['value'];
                } else {
                    $account->balance -= $transaction['value'];
                }

                $account->save();
            }

            foreach (self::BILL_TRANSACTIONS as $transactionData) {
                $merchant = Merchant::where('name', '=', $transactionData['merchant'])->first();
                $transaction = new Transaction(['merchant_id' => $merchant->id]);
                $transaction->transaction_date = $transactionData['date'];
                $transaction->value = $transactionData['value'];
                $transaction->account_id = $user->bill_account_id;
                $transaction->is_credit = $transactionData['is_credit'];

                $transaction->save();
                $account = Account::where('id', '=', $transaction->account_id)->first();

                if ($transactionData['is_credit']) {
                    $account->balance += $transactionData['value'];
                } else {
                    $account->balance -= $transaction['value'];
                }

                $account->save();
            }

            foreach (self::SAVINGS_TRANSACTIONS as $transactionData) {
                $merchant = Merchant::where('name', '=', $transactionData['merchant'])->first();
                $transaction = new Transaction(['merchant_id' => $merchant->id]);
                $transaction->transaction_date = $transactionData['date'];
                $transaction->value = $transactionData['value'];
                $transaction->account_id = $user->savings_account_id;
                $transaction->is_credit = $transactionData['is_credit'];

                $transaction->save();
                $account = Account::where('id', '=', $transaction->account_id)->first();

                if ($transactionData['is_credit']) {
                    $account->balance += $transactionData['value'];
                } else {
                    $account->balance -= $transaction['value'];
                }

                $account->save();
            }

            foreach (self::CREDIT_TRANSACTIONS as $transactionData) {
                $merchant = Merchant::where('name', '=', $transactionData['merchant'])->first();
                $transaction = new Transaction(['merchant_id' => $merchant->id]);
                $transaction->transaction_date = $transactionData['date'];
                $transaction->value = $transactionData['value'];
                $transaction->account_id = $user->credit_account_id;
                $transaction->is_credit = $transactionData['is_credit'];

                $transaction->save();
                $account = Account::where('id', '=', $transaction->account_id)->first();

                if ($transactionData['is_credit']) {
                    $account->balance += $transactionData['value'];
                } else {
                    $account->balance -= $transaction['value'];
                }

                $account->save();
            }
    }

    public function withCapitalOne(User $user)
    {
        $service = new CapitalOneService();
        $accounts = $service->createAccountSet();

        $generalAccount = new Account(['remote_id' => $accounts['general_account']]);
        $generalAccount->save();
        
        $service->getTransactionsForAccount($accounts['general_account']);

        $savingsAccount = new Account(['remote_id' => $accounts['savings_account']]);
        $savingsAccount->save();

        $billAccount = new Account(['remote_id' => $accounts['bill_account']]);
        $billAccount->save();

        $creditAccount = new Account(['remote_id' => $accounts['credit_account']]);
        $creditAccount->save();
        
        $user->general_account_id = $generalAccount->id;
        $user->savings_account_id = $savingsAccount->id;
        $user->credit_account_id = $creditAccount->id;
        $user->bill_account_id = $billAccount->id;

        $user->save();
    }
}
