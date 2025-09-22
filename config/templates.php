<?php

return [
    // Default template slug used when no admin selection is stored yet
    'default' => 'traderai-template',

    // Whitelisted public templates. Keys are folder slugs under resources/views/{slug}
    'available' => [
        'traderai-template' => [
            'label' => 'TraderAI',
            'views' => ['home', 'safe', 'redirect'],
        ],
        'fxdtradingai-template' => [
            'label' => 'FXDTradingAI',
            'views' => ['home', 'safe', 'redirect'],
        ],
        // Add more templates here later, e.g.:
        // 'pro-template' => [
        //     'label' => 'Pro Template',
        //     'views' => ['home', 'safe', 'redirect'],
        // ],
    ],
];
