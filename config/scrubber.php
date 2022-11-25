<?php

return [
    /**
     * This is the database connection that scrubber will run any queries against.
     */
    'default_connection' => env('SCRUBBER_DEFAULT_CONNECTION', config('database.default')),

    /**
     * Absolute path to the PHP configuration file, the default is set to root of the Laravel application.
     */
    'configuration_path' => env('SCRUBBER_ABSOLUTE_CONFIG_PATH', base_path('scrubber.php')),
];
