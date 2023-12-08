@props(['size' => '', 'danger' => false, 'primary' => false, 'secondary' => false, 'ghost' => false,'success' => false])

@php
    $sizes = [
        'small' => 'px-2 py-1 text-xs',
        'medium' => 'px-4 py-2 text-sm',
        'large' => 'px-6 py-3 text-base',
    ];

    $colors = [
        'primary' => [
            'bg' => 'bg-indigo-600',
            'darkBg' => 'dark:bg-indigo-400',
            'hover' => 'hover:bg-indigo-700',
            'darkHover' => 'dark:hover:bg-indigo-500',
            'focus' => 'focus:bg-indigo-700',
            'darkFocus' => 'dark:focus:bg-indigo-500',
            'active' => 'active:bg-indigo-800',
            
            'darkActive' => 'dark:active:bg-indigo-300',
            'text' => 'text-white dark:text-gray-800',
        ],
        'secondary' => [
            'bg' => 'bg-gray-800',
            'darkBg' => 'dark:bg-gray-200',
            'hover' => 'hover:bg-gray-700 dark:hover:bg-white',
            'focus' => 'focus:bg-gray-700 dark:focus:bg-white',
            'active' => 'active:bg-gray-900 dark:active:bg-gray-300',
            'text' => 'text-white dark:text-gray-800',
        ],
        
        'danger' => [
            'bg' => 'bg-red-600',
            'darkBg' => 'dark:bg-red-400',
            'hover' => 'hover:bg-red-700 dark:hover:bg-red-500',
            'focus' => 'focus:bg-red-700 dark:focus:bg-red-500',
            'active' => 'active:bg-red-800 dark:active:bg-red-300',
            'text' => 'text-white dark:text-gray-800',
        ],
        'ghost' => [
            'bg' => 'bg-transparent',
            'darkBg' => 'dark:bg-transparent',
            'hover' => 'hover:bg-gray-200 dark:hover:bg-white',
            'borderHover' => 'hover:border-opacity-50',
            'borderFocus' => 'focus:border-opacity-50',
            'text' => 'text-black dark:text-white',
        ],
    ];

    $sizeClass = array_key_exists($size, $sizes) ? $sizes[$size] : $sizes['medium'];
    $colorClass = '';

    if ($danger) {
        $colorClass = $colors['danger'];
    } elseif ($primary) {
        $colorClass = $colors['primary'];
    } elseif ($secondary) {
        $colorClass = $colors['secondary'];
    } elseif ($ghost) {
        $colorClass = $colors['ghost'];
    }else {
        // Default button style if no specific style is selected
        $colorClass = $colors['primary'];
    }

    $colorClass = implode(' ', array_values($colorClass)); // Combine color classes
@endphp

<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' =>
            'inline-flex items-center rounded-md font-semibold uppercase tracking-widest focus:outline-none transition ease-in-out duration-150 ' .
            $sizeClass .
            ' ' .
            $colorClass,
    ]) }}>
    {{ $slot }}
</button>
