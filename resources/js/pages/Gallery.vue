<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

interface GalleryItem {
    id: number;
    title: string;
    description: string;
    image: string;
}

// Sample gallery items - this should later come from your backend
const galleries: GalleryItem[] = [
    {
        id: 1,
        title: 'Kolam Pancing Utama',
        description: 'Area pancing utama dengan berbagai jenis ikan',
        image: '/images/gallery/kolam-utama.jpg'
    },
    {
        id: 2,
        title: 'Taman Keluarga',
        description: 'Area santai keluarga dengan pemandangan indah',
        image: '/images/gallery/taman-keluarga.jpg'
    },
    {
        id: 3,
        title: 'Area Bermain',
        description: 'Zona bermain anak yang aman dan menyenangkan',
        image: '/images/gallery/area-bermain.jpg'
    },
    {
        id: 4,
        title: 'Restoran Delta',
        description: 'Sajian hasil tangkapan segar',
        image: '/images/gallery/resto.jpg'
    },
    {
        id: 5,
        title: 'Kolam Premium',
        description: 'Pengalaman memancing eksklusif',
        image: '/images/gallery/kolam-premium.jpg'
    },
    {
        id: 6,
        title: 'Toko Pancing',
        description: 'Peralatan pancing lengkap',
        image: '/images/gallery/toko.jpg'
    }
];

const handleImageError = (event: Event) => {
    (event.target as HTMLImageElement).src = '/images/bg.jpg';
};
</script>

<template>
    <Head title="Gallery - Delta Fishing" />

    <div class="min-h-screen bg-gradient-to-b from-sky-400 to-blue-600">
        <!-- Navigation Bar -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="container mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5 font-bold text-xl text-white dark:text-gray-300">
                        Delta Fishing
                    </a>
                </div>
                <div class="flex lg:flex-1 justify-end gap-x-6 items-center">
                    <a href="/gallery" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Gallery</a>
                    <a href="/event" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Event</a>
                    <a href="/booking" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Booking & Menu</a>
                    <a href="/about" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">About</a>
                    <a href="/sewa" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Sewa</a>
                    <template v-if="$page.props.auth.user">
                        <div class="relative group">
                            <button class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300 flex items-center">
                                {{ $page.props.auth.user.name }}
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 py-1 w-48 bg-white rounded-md shadow-xl z-50 hidden group-hover:block">
                                <template v-if="$page.props.auth.user.role === 'admin'">
                                    <Link :href="route('dashboard')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</Link>
                                </template>
                                <!-- <Link :href="route('history')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">History</Link> -->
                                <Link :href="route('logout')" method="post" as="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</Link>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <Link :href="route('login')" class="text-sm font-semibold text-white hover:text-gray-300">Log in</Link>
                        <Link :href="route('register')" class="text-sm font-semibold text-white hover:text-gray-300">Register</Link>
                    </template>
                </div>
            </nav>
        </header>

        <div class="container mx-auto px-4 py-12 pt-24">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-4">Gallery Delta Fishing</h1>
                <p class="text-white/90 text-lg max-w-2xl mx-auto">Jelajahi keindahan dan fasilitas Delta Fishing melalui galeri foto kami</p>
            </div>

            <div class="grid gap-8">
                <!-- Featured Large Image -->
                <div class="relative h-[500px] w-full overflow-hidden rounded-2xl shadow-2xl group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 flex flex-col justify-end">
                        <div class="p-8 transform transition-transform duration-300 translate-y-4 group-hover:translate-y-0">
                            <h2 class="text-3xl font-bold text-white mb-2">{{ galleries[0].title }}</h2>
                            <p class="text-white/90 text-lg">{{ galleries[0].description }}</p>
                        </div>
                    </div>
                    <img 
                        :src="galleries[0].image" 
                        :alt="galleries[0].title"
                        class="h-full w-full object-cover transform transition-transform duration-500 group-hover:scale-105"
                        @error="handleImageError"
                    />
                </div>

                <!-- Grid of Smaller Images -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="gallery in galleries.slice(1)" 
                         :key="gallery.id" 
                         class="group relative h-[300px] overflow-hidden rounded-xl shadow-xl 
                                transform transition-all duration-300 hover:scale-[1.02]"
                    >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-10">
                            <div class="absolute bottom-0 p-6 transform transition-transform duration-300 translate-y-2 group-hover:translate-y-0">
                                <h3 class="text-xl font-bold text-white mb-2">{{ gallery.title }}</h3>
                                <p class="text-white/90 text-sm">{{ gallery.description }}</p>
                            </div>
                        </div>
                        <img 
                            :src="gallery.image" 
                            :alt="gallery.title"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            @error="handleImageError"
                        />
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700">
            <div class="container mx-auto py-6 px-6 lg:px-8 text-center text-gray-600 dark:text-gray-400">
                &copy; {{ new Date().getFullYear() }} Delta Fishing. All Rights Reserved.
            </div>
        </footer>
    </div>
</template>

<style scoped>
.container {
    max-width: 1400px;
}
</style>