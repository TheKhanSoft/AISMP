<div>
    <!-- Hero Section -->
    <div class="bg-slate-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">Contact Us</h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </div>

    <div class="bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
                
                <!-- Contact Info & Map -->
                <div class="p-8 lg:p-12 bg-indigo-600 text-white flex flex-col justify-between">
                    <div>
                        <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
                        <p class="text-indigo-100 mb-8 text-lg">Fill out the form and our team will get back to you within 24 hours.</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 w-6 h-6 text-indigo-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-white">Office</h3>
                                    <p class="mt-1 text-indigo-100">123 AI Boulevard, Tech Park<br>San Francisco, CA 94107</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 w-6 h-6 text-indigo-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-white">Phone</h3>
                                    <p class="mt-1 text-indigo-100">+1 (555) 123-4567</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 w-6 h-6 text-indigo-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-white">Email</h3>
                                    <p class="mt-1 text-indigo-100">contact@aisociety.org</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-12 rounded-xl overflow-hidden h-64 bg-indigo-500 flex items-center justify-center">
                        <span class="text-indigo-200 text-sm font-medium">Google Maps Embed Placeholder</span>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    @if (session('success'))
                        <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    <form wire:submit="submit" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                            <input type="text" id="name" wire:model="name" class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-slate-50 transition-colors" placeholder="John Doe">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                            <input type="email" id="email" wire:model="email" class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-slate-50 transition-colors" placeholder="john@example.com">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-700">Subject</label>
                            <input type="text" id="subject" wire:model="subject" class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-slate-50 transition-colors" placeholder="How can we help you?">
                            @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700">Message</label>
                            <textarea id="message" wire:model="message" rows="4" class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-slate-50 transition-colors resize-none" placeholder="Write your message here..."></textarea>
                            @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                <span wire:loading.remove wire:target="submit">Send Message</span>
                                <span wire:loading wire:target="submit">Sending...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
