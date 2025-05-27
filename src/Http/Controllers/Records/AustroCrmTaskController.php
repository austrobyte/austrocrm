<?php

namespace Austro\Crm\Http\Controllers\Records;

use GuzzleHttp\Client;
use Austro\Crm\Http\Controllers\Auth\AustroCrmTokenCheck;

class AustroCrmTaskController
{
    public static function createSingleTask($data = [])
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
            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/task', [
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Consider logging the exception or handling it as needed
            return null;
        }
    }
}
