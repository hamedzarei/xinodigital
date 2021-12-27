<?php

return [
    'custom' => [
        '201' => 'successfully created',
        '400' => 'bad request',
        '401' => 'unauthorized',
        '403' => 'forbidden',
        '404' => 'resource not found',
        '405' => 'method not allowed',
        '409' => 'resource conflict',
        '429' => 'too many request exception, retry after :retry hours',
        '500' => 'internal server error',
        'token' => [
            'revoke' => 'successfully revoked',
            'client_revoke_notice' => 'your old token is going to revoke in 24 hours'
        ],
        'error' => [
            'no_data' => 'your request has no content or content is not valid',
            'odata' => 'odata query is not valid',
            'try_later' => 'please try later',
            'exist_plan_for_next_period' => 'you can not create new invoice, because have plan for next period!',
            'fields_not_supplied' => 'fields not supplied',
            'validation_regex' => 'validation.regex',
            'empty_result' => 'empty result',
            'not_found' => 'not found',
            'resource_not_found' => 'resource not found',
            'unauthorized' => 'unauthorized',
            'unsupported_data_type' => 'data type is not supported.',
            'invalid_query_bbox' => 'The queried columns is not present in the table or is not geometry type.',
            'unsupported_default_value' => 'specified format for default value us not supported.',
            'data_type_conversion_failure' => 'could not convert data type.',
            'redis_database_conn_info_not_found' => 'database connection information is not available.',
            'redis_table_info_not_found' => "couldn't find table associated with the dataset.",
            'ordering_table' => 'could not table ordering',
        ],
        'success' => [
            'update' => 'updated successfully',
            'create' => 'successfully created',
            'delete' => 'successfully deleted',
            'validation_email_sent' => 'validation email sent',
            'ok_validation' => 'your account has been successfully validated',
            'forgot_password' => 'please check your email to continue!',
            'unsubscribe' => 'you have unsubscribed successfully',
            'ordering' => 'create successful task sorting'
        ]
    ]
];
