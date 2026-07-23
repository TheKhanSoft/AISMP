@props([
    'title' => 'Are you sure?',
    'text' => 'You won\'t be able to revert this!',
    'confirmText' => 'Yes, proceed',
    'cancelText' => 'Cancel',
    'icon' => 'warning',
])

<div x-data="{
    confirm() {
        Swal.fire({
            title: '{{ $title }}',
            text: '{{ $text }}',
            icon: '{{ $icon }}',
            showCancelButton: true,
            confirmButtonColor: 'var(--color-primary-600)',
            cancelButtonColor: 'var(--color-slate-500)',
            confirmButtonText: '{{ $confirmText }}',
            cancelButtonText: '{{ $cancelText }}'
        }).then((result) => {
            if (result.isConfirmed) {
                {{ $attributes->get('wire:click') ? '$wire.' . $attributes->get('wire:click') . '()' : '' }}
                $dispatch('confirmed');
            }
        });
    }
}"
class="inline-block"
>
    <div @click.prevent="confirm()">
        {{ $slot }}
    </div>
</div>
