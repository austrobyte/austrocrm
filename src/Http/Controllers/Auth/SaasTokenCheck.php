<?php

namespace Smdm\SaasCrm\Http\Controllers\Auth;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Smdm\SaasCrm\Models\SaasCrmAccess;

class SaasTokenCheck
{
    public static function getToken()
    {
        $crm_access = SaasCrmAccess::latest()->first();

        $client_id = config('saas-crm.saas_crm_client_id');
        $client_secret = config('saas-crm.saas_crm_client_secret');

        if ($crm_access) {
            $expiry_time = Carbon::parse($crm_access->expiry_time);

            if ($expiry_time->gt(Carbon::now())) {
                $saas_token = self::login($client_id, $client_secret);

                $crm_access->access_token = $saas_token['access_token'];
                $crm_access->unified_token = $saas_token['unified_token'];
                $crm_access->save();

                return $saas_token;
            }

            return [
                'access_token' => $crm_access->access_token,
                'unified_token' => $crm_access->unified_token,
            ];
        } else {
            $saas_token = self::login($client_id, $client_secret);
            SaasCrmAccess::create([
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'access_token' => $saas_token['access_token'],
                'unified_token' => $saas_token['unified_token'],
                'expiry_time' => Carbon::now()->addMonths(11)->addHours(11),
                'status' => 'active',
            ]);

            return $saas_token;
        }

        return null;
    }

    public static function login($email, $password)
    {
        $client = new Client([
            'base_uri' => config('saas-crm.saas_crm_api_base_url'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            $response = $client->request('POST', rtrim(config('saas-crm.saas_crm_api_version'), '/') . '/saas_service/auth/login', [
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'user_type' => 'system',
                    'user_subtype' => 'oauth',
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['token'])) {
                return [
                    'access_token' => $responseData['token'],
                    'unified_token' => $responseData['userUnifiedToken'],
                ];
            } else {
                return response()->json(['message' => 'Login failed'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Login failed'], 401);
        }
    }

    public static function getClient($token)
    {
        return new Client([
            'base_uri' => config('saas-crm.saas_crm_api_base_url'),
            'headers' => [
                'Authorization' => 'Bearer '.$token['access_token'],
                'X-User-Unique-Token' => $token['unified_token'],
                'X-Organization-Access-Token' => 33,
                'X-Organization-Id' => 1,
                'X-Organization-Name' => 'SaaS CRM',
                'X-Organization-Token' => 11
            ],
        ]);
    }
}
