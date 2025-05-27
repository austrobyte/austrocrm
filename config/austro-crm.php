<?php

return [
    'austro_crm_client_id' => env('austro_crm_CLIENT_ID', ''),
    'austro_crm_client_secret' => env('austro_crm_CLIENT_SECRET', ''),
    'austro_crm_api_version' => env('austro_crm_API_VERSION', '/api/v1'),
    'austro_crm_api_base_url' => env('austro_crm_API_BASE_URL', 'http://127.0.0.1:8000'),
    'austro_crm_ignore_login_recaptcha_secret_code' => env('austro_crm_IGNORE_LOGIN_RECAPTCHA_SECRET_CODE', ''),

    'organization' => [
        'id' => env('austro_crm_ORGANIZATION_ID'),
        'name' => env('austro_crm_ORGANIZATION_NAME'),
        'token' => env('austro_crm_ORGANIZATION_TOKEN'),
        'access_token' => env('austro_crm_ORGANIZATION_ACCESS_TOKEN'),
    ]
];
