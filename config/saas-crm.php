<?php

return [
    'saas_crm_client_id' => env('SAAS_CRM_CLIENT_ID', ''),
    'saas_crm_client_secret' => env('SAAS_CRM_CLIENT_SECRET', ''),
    'saas_crm_api_version' => env('SAAS_CRM_API_VERSION', '/api/v1'),
    'saas_crm_api_base_url' => env('SAAS_CRM_API_BASE_URL', 'http://127.0.0.1:8000'),

    'organization' => [
        'id' => env('SAAS_CRM_ORGANIZATION_ID'),
        'name' => env('SAAS_CRM_ORGANIZATION_NAME'),
        'token' => env('SAAS_CRM_ORGANIZATION_TOKEN'),
        'access_token' => env('SAAS_CRM_ORGANIZATION_ACCESS_TOKEN'),
    ]
];
