@props(['type', 'title', 'message'])

@php
    $bgColor = '';
    $borderColor = '';
    $textColor = '';
    $icon = '';
    $iconBg = '';
    $iconBorder = '';
    $iconText = '';

    switch ($type) {
        case 'success':
            $bgColor = 'bg-teal-50';
            $borderColor = 'border-teal-500';
            $textColor = 'text-teal-800';
            $iconBg = 'bg-teal-200';
            $iconBorder = 'border-teal-100';
            $iconText = 'text-teal-800';
            $icon =
                '<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>';
            break;
        case 'error':
            $bgColor = 'bg-red-50';
            $borderColor = 'border-red-500';
            $textColor = 'text-red-800';
            $iconBg = 'bg-red-200';
            $iconBorder = 'border-red-100';
            $iconText = 'text-red-800';
            $icon =
                '<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>';
            break;
        case 'warning':
            $bgColor = 'bg-yellow-50';
            $borderColor = 'border-yellow-500';
            $textColor = 'text-yellow-800';
            $iconBg = 'bg-yellow-200';
            $iconBorder = 'border-yellow-100';
            $iconText = 'text-yellow-800';
            $icon =
                '<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>';
            break;
        case 'info':
            $bgColor = 'bg-blue-50';
            $borderColor = 'border-blue-500';
            $textColor = 'text-blue-800';
            $iconBg = 'bg-blue-200';
            $iconBorder = 'border-blue-100';
            $iconText = 'text-blue-800';
            $icon =
                '<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>';
            break;
        default:
            $bgColor = 'bg-gray-50';
            $borderColor = 'border-gray-500';
            $textColor = 'text-gray-800';
            $iconBg = 'bg-gray-200';
            $iconBorder = 'border-gray-100';
            $iconText = 'text-gray-800';
            $icon =
                '<svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>'; // Default to success icon
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => "$bgColor border-t-2 $borderColor rounded-md p-4"]) }} role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <span
                class="inline-flex justify-center items-center size-8 rounded-full border-4 {{ $iconBorder }} {{ $iconBg }} {{ $iconText }}">
                {!! $icon !!}
            </span>
        </div>
        <div class="ms-3">
            <h3 class="text-gray-800 font-semibold">
                {{ $title }}
            </h3>
            <p class="text-sm text-gray-700">
                {{ $message }}
            </p>
        </div>
    </div>
</div>
