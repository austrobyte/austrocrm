<?php

namespace Austro\Crm\Http\Controllers\Records;

use GuzzleHttp\Client;
use Austro\Crm\Http\Controllers\Auth\AustroCrmTokenCheck;

class AustroCrmAvailabilityController
{
    public static function search($phrase)
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

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/availability/search', [
                'json' => ['query' => $phrase],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle the exception or log it
            return null; // or return a meaningful error message
        }
    }

    public static function availabilitySearchById($availability_id)
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

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/availability/search', [
                'json' => ['availability_id' => $availability_id],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle the exception or log it
            return null; // or return a meaningful error message
        }

    }

    public static function createSingleAvailability($data = [])
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
            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/availability', [
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Consider logging the exception or handling it as needed
            return null;
        }
    }
}
