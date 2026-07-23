// bootstrap.js removed
import 'aos/dist/aos.css';
import AOS from 'aos';
import Swal from 'sweetalert2';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

// Global Notyf instance setup
window.notyf = new Notyf({
    duration: 4000,
    position: { x: 'right', y: 'top' },
    types: [
        { type: 'success', background: 'var(--color-success-500)', icon: false },
        { type: 'error', background: 'var(--color-danger-500)', icon: false },
        { type: 'warning', background: 'var(--color-warning-500)', icon: false },
        { type: 'info', background: 'var(--color-info-500)', icon: false }
    ]
});

window.Swal = Swal;

// Alpine.js store and initialization
document.addEventListener('alpine:init', () => {
    // Dark Mode Store
    Alpine.store('darkMode', {
        on: localStorage.getItem('darkMode') === 'true' || 
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggle() {
            this.on = !this.on;
            localStorage.setItem('darkMode', this.on);
            this.applyTheme();
        },
        applyTheme() {
            if (this.on) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        init() {
            this.applyTheme();
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Apply theme on load independent of Alpine to prevent flash
    const isDark = localStorage.getItem('darkMode') === 'true' || 
        (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
    if(isDark) document.documentElement.classList.add('dark');

    // Initialize AOS
    AOS.init({
        once: true,
        offset: 50,
        duration: 600,
        easing: 'ease-out-cubic',
    });
});

// Livewire Event Listeners for Notifications
document.addEventListener('livewire:initialized', () => {
    Livewire.on('notify', (event) => {
        const data = event[0] || event;
        const type = data.type || 'info';
        const message = data.message || '';
        
        if (type === 'success') window.notyf.success(message);
        else if (type === 'error') window.notyf.error(message);
        else window.notyf.open({ type: type, message: message });
    });

    Livewire.on('swal', (event) => {
        const data = event[0] || event;
        Swal.fire({
            title: data.title || '',
            text: data.text || '',
            icon: data.icon || 'info',
            confirmButtonColor: 'var(--color-primary-600)',
            cancelButtonColor: 'var(--color-danger-600)',
            showCancelButton: data.showCancelButton || false,
        }).then((result) => {
            if (result.isConfirmed && data.onConfirm) {
                Livewire.dispatch(data.onConfirm, data.confirmParams || {});
            }
        });
    });
});
