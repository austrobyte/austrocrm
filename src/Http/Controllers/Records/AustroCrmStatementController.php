<?php

namespace Austro\Crm\Http\Controllers\Records;

use GuzzleHttp\Client;
use Austro\Crm\Http\Controllers\Auth\AustroCrmTokenCheck;

class AustroCrmStatementController
{
    public static function panelStatistics()
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

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/kpi/get-statistics', [
                'json' => [],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle the exception or log it
            return null; // or return a meaningful error message
        }

    }

    public static function panelRfqStatisticsMonthly()
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

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/kpi/get-rfq-statistics-monthly', [
                'json' => [],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle the exception or log it
            return null; // or return a meaningful error message
        }

    }
}
