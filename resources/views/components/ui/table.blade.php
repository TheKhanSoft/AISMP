@props([
    'striped' => false,
    'hoverable' => true,
])

@php
    $tableClasses = 'min-w-full divide-y divide-slate-200 dark:divide-slate-700';
    $tbodyClasses = 'bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700';
    
    if ($striped) {
        $tbodyClasses .= ' [&>tr:nth-child(even)]:bg-slate-50 dark:[&>tr:nth-child(even)]:bg-slate-800/50';
    }
    
    if ($hoverable) {
        $tbodyClasses .= ' [&>tr:hover]:bg-slate-50 dark:[&>tr:hover]:bg-slate-700/50 [&>tr]:transition-colors';
    }
@endphp

<div class="overflow-x-auto shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 rounded-lg">
    <table class="{{ $tableClasses }}">
        @if(isset($header))
            <thead class="bg-slate-50 dark:bg-slate-800/80">
                <tr>
                    {{ $header }}
                </tr>
            </thead>
        @endif
        
        <tbody class="{{ $tbodyClasses }}">
            {{ $body ?? $slot }}
            
            @if(isset($empty) && trim($empty) !== '')
                <tr>
                    <td colspan="100%" class="px-6 py-12 text-center">
                        {{ $empty }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
