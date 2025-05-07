<?php

declare(strict_types=1);

return [
    'name' => 'AI',
    // 'icon' => 'heroicon-o-cog', // icon on dashboard
    // 'icon' => 'fas-air-freshener',
    'icon' => 'ui-brain',
    'navigation_sort' => 1,
<<<<<<< HEAD
    'fine_tuning_url' => config('FINE_TUNING_API_URL', 'http://localhost:8000/api/fine-tuning'), // Usare config() invece di env() per compatibilità con la cache di configurazione
=======
<<<<<<< HEAD
    'fine_tuning_url' => env('FINE_TUNING_API_URL', 'http://localhost:8000/api/fine-tuning'),
=======
    'fine_tuning_url' => config('FINE_TUNING_API_URL', 'http://localhost:8000/api/fine-tuning'), // Usare config() invece di env() per compatibilità con la cache di configurazione
>>>>>>> origin/dev
>>>>>>> c7c37b5 (.)
];
