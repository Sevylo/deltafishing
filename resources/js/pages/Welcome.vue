<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

const showDropdown = ref(false);

// Setup parallax effect for text elements
onMounted(() => {
    const handleParallax = () => {
        const parallaxElements = document.querySelectorAll('.parallax-text');
        const scrolled = window.pageYOffset;
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.3;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    };

    window.addEventListener('scroll', handleParallax);

    // Cleanup
    onUnmounted(() => {
        window.removeEventListener('scroll', handleParallax);
    });
});

// Setup fade-in animation on scroll
onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.reveal').forEach((element) => {
        observer.observe(element);
    });

    // Cleanup
    onUnmounted(() => {
        document.querySelectorAll('.reveal').forEach((element) => {
            observer.unobserve(element);
        });
    });
});
</script>

<template>
    <Head title="Selamat Datang di Delta Fishing"/>

    <div class="text-white">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="container mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5 font-bold text-xl text-white dark:text-gray-300">
                        Delta Fishing
                    </a>
                </div>
                <div class="flex lg:flex-1 justify-end gap-x-6 items-center">
                    <a href="/gallery" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Gallery</a>
                    <a href="/sewa" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Sewa</a>
                    <a href="/event" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Event</a>
                    <a href="/about" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">About</a>
                    <a href="/booking" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Booking & Menu</a>
                    <template v-if="$page.props.auth.user">
                        <a href="/history" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">History</a>
                        <div class="relative">
                            <button @click="showDropdown = !showDropdown" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">
                                {{ $page.props.auth.user.name }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div v-if="showDropdown" class="absolute right-0 mt-2 py-1 w-48 bg-white rounded-md shadow-xl z-50">
                                <template v-if="$page.props.auth.user.role === 'admin'">
                                    <Link :href="route('dashboard')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</Link>
                                </template>
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

        <main>
            <!-- Hero Section - Original Image -->
            <div class="relative isolate overflow-hidden pt-14 h-screen">
                <img src="/images/bg2.jpg" class="absolute inset-0 -z-10 h-full w-full object-cover" />
                <div class="absolute inset-0 -z-10 bg-black/10"></div>
                <div class="container mx-auto h-full flex items-center px-6 lg:px-8">
                    <div class="max-w-2xl text-white reveal">
                        <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">Mancing Seru, Makan Enak di Delta Fishing</h1>
                        <p class="mt-6 text-lg leading-8">Nikmati sensasi tarikan ikan dan kelezatan hidangan khas pedesaan di satu tempat. Suasana asri, fasilitas lengkap, cocok untuk keluarga.</p>
                        <div class="mt-10">
                            <a href="/booking" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-blue-600 shadow-sm hover:bg-blue-500 hover:text-white focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-blue-600">Reservasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What We Offer Section - Shallow Waters -->
            <section class="py-12 sm:py-24 bg-gradient-to-b from-sky-400 to-blue-500">
                <div class="container mx-auto px-6 lg:px-8">
                    <div class="text-center reveal">
                        <h2 class="text-3xl font-bold tracking-tight">Apa yang Kami Tawarkan?</h2>
                        <p class="mt-4 text-lg text-white">Dua pengalaman istimewa menanti Anda.</p>
                    </div>
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="rounded-lg border border-gray-200 p-8 reveal">
                            <h3 class="text-xl font-semibold">Kolam Pemancingan</h3>
                            <p class="mt-2 text-white">Kolam luas dengan berbagai jenis ikan seperti Patin, Bawal, dan Nila. Sistem pance harian dan kiloan tersedia. Kebersihan air selalu terjaga untuk kepuasan Anda.</p>
                        </div>
                        <div class="rounded-lg border border-gray-200 p-8 reveal">
                            <h3 class="text-xl font-semibold">Restoran & Saung Lesehan</h3>
                            <p class="mt-2 text-white">Santap hasil pancingan Anda yang diolah langsung oleh koki kami. Nikmati hidangan di saung-saung bambu dengan pemandangan danau yang menenangkan.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Gallery Section - Mid-depths -->
            <section class="py-12 sm:py-24 bg-gradient-to-b from-blue-500 to-blue-600">
                <div class="container mx-auto px-6 lg:px-8">
                    <div class="text-center mb-16 reveal">
                        <h2 class="text-3xl font-bold tracking-tight text-white">Galeri Delta Fishing</h2>
                        <p class="mt-4 text-lg text-blue-100">Lihat momen-momen seru di tempat kami.</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <img src="https://images.unsplash.com/photo-1516408388733-2f8364f2e00b?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dHJvcGljYWwlMjBmaXNofGVufDB8fDB8fHww" class="rounded-lg shadow-lg aspect-square object-cover reveal" alt="Galeri 1">
                        <img src="https://images.unsplash.com/photo-1516408388733-2f8364f2e00b?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dHJvcGljYWwlMjBmaXNofGVufDB8fDB8fHww" class="rounded-lg shadow-lg aspect-square object-cover reveal" alt="Galeri 2">
                        <img src="https://images.unsplash.com/photo-1516408388733-2f8364f2e00b?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dHJvcGljYWwlMjBmaXNofGVufDB8fDB8fHww" class="rounded-lg shadow-lg aspect-square object-cover reveal" alt="Galeri 3">
                        <img src="https://images.unsplash.com/photo-1516408388733-2f8364f2e00b?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dHJvcGljYWwlMjBmaXNofGVufDB8fDB8fHww" class="rounded-lg shadow-lg aspect-square object-cover reveal" alt="Galeri 4">
                    </div>
                </div>
            </section>

            <!-- Contact Section - Deep Waters -->
            <section id="kontak" class="py-12 sm:py-24 bg-gradient-to-b from-blue-600 to-blue-800">
                <div class="container mx-auto px-6 lg:px-8">
                    <div class="text-center mb-16 reveal">
                        <h2 class="text-3xl font-bold tracking-tight text-white">Kunjungi Kami</h2>
                        <p class="mt-4 text-lg text-blue-100">Kami siap menyambut kedatangan Anda dan keluarga.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div class="reveal">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3208666968244!2d112.7493615747191!3d-7.429700173191602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e684ffffffff%3A0x93663aaf5a5944e1!2sDelta%20Fishing!5e0!3m2!1sen!2sid!4v1750253185058!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="space-y-4 reveal">
                             <div>
                                <h3 class="font-semibold">Alamat</h3>
                                <p>Prasung, Buduran, Kabupaten Sidoarjo, Jawa Timur 61252</p>
                            </div>
                            <div>
                                <h3 class="font-semibold">Jam Buka</h3>
                                <p>Setiap Hari: 08:00 - 22:00 WIB</p>
                            </div>
                            <div>
                                <h3 class="font-semibold">Reservasi & Informasi</h3>
                                <p class="text-blue-300 dark:text-blue-400 font-bold text-lg">(031) 8967733</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700">
        <div class="container mx-auto py-6 px-6 lg:px-8 text-center text-gray-600 dark:text-gray-400">
            &copy; {{ new Date().getFullYear() }} Delta Fishing. All Rights Reserved.
        </div>
    </footer>
</template>

<style>
.parallax-text {
    transform: translateY(0);
    will-change: transform;
}

.reveal {
    opacity: 0;
    transform: translateY(100px);
    transition: all 1s ease;
}

.reveal.show {
    opacity: 1;
    transform: translateY(0);
}
</style>