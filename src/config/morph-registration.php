<?php

/**
 * @license MIT
 * @package WalkerChiu\Registration
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Switch association of package to On or Off
    |--------------------------------------------------------------------------
    |
    | When you set someone On:
    |     1. Its Foreign Key Constraints will be created together with data table.
    |     2. You may need to change the corresponding class settings in the config/wk-core.php.
    |
    | When you set someone Off:
    |     1. Association check will not be performed on FormRequest and Observer.
    |     2. Cleaner and Initializer will not handle tasks related to it.
    |
    | Note:
    |     The association still exists, which means you can still access related objects.
    |
    */
    'onoff' => [
        'user' => 1,

        'group'    => 0,
        'rule'     => 0,
        'rule-hit' => 0,
        'site'     => 0
    ],

    /*
    |--------------------------------------------------------------------------
    | Command
    |--------------------------------------------------------------------------
    |
    | Location of Commands.
    |
    */
    'command' => [
        'cleaner' => 'WalkerChiu\MorphRegistration\Console\Commands\MorphRegistrationCleaner'
    ],

    /*
    |--------------------------------------------------------------------------
    | The states which allow users to modify the data
    |--------------------------------------------------------------------------
    |
    */
    'states_can_modify' => [
        0, 1, 2
    ]
];
