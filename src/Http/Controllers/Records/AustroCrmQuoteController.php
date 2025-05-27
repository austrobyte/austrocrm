<?php

namespace Austro\Crm\Http\Controllers\Records;

use GuzzleHttp\Client;
use Austro\Crm\Http\Controllers\Auth\AustroCrmTokenCheck;

class AustroCrmQuoteController
{
    public static function getCrmQuoteById($quote_id)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return null;
        }

        $client = new Client([
            'base_uri' => config('austro-crm.austro_crm_api_base_url'),
            'headers' => [
                'Authorization' => 'Bearer '.$token['access_token'],
                'X-User-Unique-Token' => $token['unified_token'],
            ],
        ]);

        try {

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/quote/get-by-id', [
                'json' => ['quote_id' => $quote_id],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function getQuotePDF($quote_id)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return null;
        }

        $client = new Client([
            'base_uri' => config('austro-crm.austro_crm_api_base_url'),
            'headers' => [
                'Authorization' => 'Bearer '.$token['access_token'],
                'X-User-Unique-Token' => $token['unified_token'],
            ],
        ]);

        try {

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/quote/'.$quote_id.'/get-pdf', [
                'json' => ['quote_id' => $quote_id],
            ]);

            return $response;

        } catch (\Exception $e) {
            // Handle the exception or log it
            return null; // or return a meaningful error message
        }

    }
}
