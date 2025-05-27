<?php

namespace Austro\Crm\Http\Controllers\Auth;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Austro\Crm\Models\AustroCrmToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AustroCrmTokenCheck
{
    /**
     * Get valid token, refreshing if necessary
     */
    public static function getToken(): array
    {
        $crm_access = AustroCrmToken::latest()->first();

        $client_id = config('austro-crm.austro_crm_client_id');
        $client_secret = config('austro-crm.austro_crm_client_secret');

        if ($crm_access) {
            $expiry_time = Carbon::parse($crm_access->expiry_time);

            if ($expiry_time->lte(Carbon::now()->addHour())) {
                $token = self::login($client_id, $client_secret);
                
                if (!$token) {
                    Log::error('Failed to refresh expired token');
                    throw new \Exception('Token refresh failed');
                }
                
                $crm_access->update([
                    'access_token' => $token['access_token'],
                    'unified_token' => $token['unified_token'],
                    'expiry_time' => Carbon::now()->addMonths(11)->addHours(11),
                ]);

                return $token;
            }

            return [
                'access_token' => $crm_access->access_token,
                'unified_token' => $crm_access->unified_token,
            ];
        }

        $token = self::login($client_id, $client_secret);
        
        if (!$token) {
            Log::error('Failed to create initial token');
            throw new \Exception('Initial token creation failed');
        }

        AustroCrmToken::create([
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'access_token' => $token['access_token'],
            'unified_token' => $token['unified_token'],
            'expiry_time' => Carbon::now()->addMonths(11)->addHours(11),
            'status' => 'active',
        ]);

        return $token;
    }

    /**
     * Login to AustroCRM and get access token
     */
    public static function login(string $email, string $password): ?array
    {
        try {
            $client = new Client([
                'base_uri' => config('austro-crm.austro_crm_api_base_url'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 30,
            ]);

            $no_recaptcha_token = config('austro-crm.austro_crm_ignore_login_recaptcha_secret_code');
            
            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/') . '/saas_service/auth/login', [
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'user_type' => 'system',
                    'user_subtype' => 'oauth',
                    'ignore_recaptcha_code' => $no_recaptcha_token
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);
            
            if (isset($responseData['token']) && isset($responseData['userUnifiedToken'])) {
                return [
                    'access_token' => $responseData['token'],
                    'unified_token' => $responseData['userUnifiedToken'],
                ];
            }

            Log::error('Login response missing required tokens', ['response' => $responseData]);
            return null;

        } catch (RequestException $e) {
            Log::error('AustroCRM login request failed', [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return null;
        } catch (\Exception $e) {
            Log::error('AustroCRM login failed', [
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Get configured HTTP client with authentication headers
     */
    public static function getClient(array $token): Client
    {
        return new Client([
            'base_uri' => config('austro-crm.austro_crm_api_base_url'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token['access_token'],
                'X-User-Unique-Token' => $token['unified_token'],
                'X-Organization-Access-Token' => config('austro-crm.organization.access_token', 33),
                'X-Organization-Id' => config('austro-crm.organization.id', 1),
                'X-Organization-Name' => config('austro-crm.organization.name', 'SaaS CRM'),
                'X-Organization-Token' => config('austro-crm.organization.token', 11),
            ],
            'timeout' => 30,
        ]);
    }
}
