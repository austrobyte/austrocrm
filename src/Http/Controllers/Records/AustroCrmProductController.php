<?php

namespace Austro\Crm\Http\Controllers\Records;

use GuzzleHttp\Client;
use Austro\Crm\Http\Controllers\Auth\AustroCrmTokenCheck;
use Austro\Crm\ServiceResponse;

class AustroCrmProductController
{
    public static function search($phrase, $limit = 20)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {
            $response = $client->request('GET', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/external/product/search', [
                'json' => [
                    'query' => $phrase,
                    'limit' => 20
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to search products',
                'data' => []
            ]))->toArray();
        }
    }

    public static function productsSearchById($id)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {
            $response = $client->request('GET', rtrim(config('austro-crm.austro_crm_api_version'), '/')."/external/product/$id/view");

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the product',
                'data' => []
            ]))->toArray();
        }
    }


    public static function getLatestProducts($limit = 8)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {

            $response = $client->request('GET', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/external/product/get-latest', [
                'json' => ['limit' => $limit],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the latest products',
                'data' => []
            ]))->toArray();
        }
    }

    public static function getLatestProductsByManufacturerId($manufacturerId, $limit = 8)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {
            $response = $client->request('GET', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/external/product/get-latest-by-manufacturer-id', [
                'json' => ['limit' => $limit, 'manufacturer_id' => $manufacturerId],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the latest products',
                'data' => []
            ]))->toArray();
        }
    }

    public static function searchByNameAndManufacturerId($product_name, $manufacture_id)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product/search', [
                'json' => ['query' => $product_name, 'manufacture_id' => $manufacture_id],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function getProductsByIds($ids)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product/get-by-ids', [
                'json' => ['ids' => $ids],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the the the the the the the the products',
                'data' => []
            ]))->toArray();
        }
    }

    public static function getProductAvailability($product_id, $days)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product/get-availability', [
                'json' => ['product_id' => $product_id, 'days' => $days],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the product availabilities',
                'data' => []
            ]))->toArray();
        }

    }

    public static function getProductExcesses($product_id)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {

            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product/get-excess', [
                'json' => ['product_id' => $product_id],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the product excesses',
                'data' => []
            ]))->toArray();
        }

    }

    public static function createSingleProduct($data = [])
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {
            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product', [
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to create the product',
                'data' => []
            ]))->toArray();
        }
    }

    public static function getProductLookUp($data = [])
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {
            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product/get-lookup', [
                'json' => ['input_data' => $data],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the products',
                'data' => []
            ]))->toArray();
        }
    }

    public static function getProductAvailabilityCondition($product_id, $created_at = null, $fields = null, $conditions = null)
    {
        $token = AustroCrmTokenCheck::getToken();

        if (! $token) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => 401,
                'error' => 'Unauthorized',
                'message' => 'You are not authenticated',
                'data' => []
            ]))->toArray();
        }

        $client = AustroCrmTokenCheck::getClient($token);

        try {
            $response = $client->request('POST', rtrim(config('austro-crm.austro_crm_api_version'), '/').'/product/get-availability-conditions', [
                'json' => [
                    'product_id' => $product_id,
                    'created_at' => $created_at,
                    'fields' => $fields,
                    'conditions' => $conditions,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return (new ServiceResponse([
                'status' => false,
                'status_code' => $e->getCode(),
                'error' => $e->getMessage(),
                'message' => 'Failed to get the product availabilities',
                'data' => []
            ]))->toArray();
        }
    }
}
