<?php

return [
    'scrubber_test' => [
        'first_name' => [
            'primary_key' => 'id',
            'value' => 'faker.firstName',
            'type' => 'pid',
        ],
        'last_name' => [
            'value' => 'faker.lastName',
            'type' => 'pid',
        ],
        'email' => [
            'value' => 'faker.email',
            'type' => 'pid',
        ],
        'toggle' => [
            'value' => static fn (): bool => true,
        ],
    ],
];
