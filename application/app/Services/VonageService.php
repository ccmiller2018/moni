<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class VonageService
{
    private Client $client;

    public function __construct()
    {
        $basic = new Basic(Config::get('vonage.apiKey'), Config::get('vonage.apiSecret'));
        $this->client = new Client($basic);
    }

    private function getClient(): Client
    {
        return $this->client;
    }

    public function sendSms(string $content, string $mobileNumber): bool
    {
        $sms = new SMS($mobileNumber, '+447763044658', $content);
        
        $response = $this->getClient()->sms()->send($sms);

        $message = $response->current();

        return $message->getStatus() === 0;
    }
}
