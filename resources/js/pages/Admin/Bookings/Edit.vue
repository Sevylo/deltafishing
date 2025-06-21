<script>
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
export default {
    layout: AppSidebarLayout,
};
</script>

<script setup>
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    booking: {
        type: Object,
        required: true,
    },
    menus: {
        type: Array,
        required: true,
    }
});

const form = useForm({
    nama_pemesan: props.booking.nama_pemesan,
    tanggal_booking: props.booking.tanggal_booking,
    jam_booking: props.booking.jam_booking,
    nomor_meja: props.booking.nomor_meja || '',
});

const items = ref(props.booking.items.map(item => ({ ...item })));

const menuMap = {};
props.menus.forEach(menu => {
    menuMap[menu.name] = menu.price;
});

watch(items, (newItems) => {
    newItems.forEach(item => {
        if (item.menu_name && menuMap[item.menu_name] && item.price !== menuMap[item.menu_name]) {
            item.price = menuMap[item.menu_name];
        }
    });
}, { deep: true });

const updateBooking = () => {
    form.put(route('admin.bookings.update', props.booking.id), {
        preserveScroll: true,
        onSuccess: () => {
            router.visit(route('admin.bookings.index'));
        },
    });
};

const updateItem = (item) => {
    router.put(route('admin.booking_items.update', item.id), item, {
        preserveScroll: true,
        onSuccess: () => {
            // Optional: show success message
        },
    });
};

const deleteItem = (item) => {
    if (confirm('Hapus item ini?')) {
        router.delete(route('admin.booking_items.destroy', item.id), {
            preserveScroll: true,
            onSuccess: () => {
                // Optional: remove from local list or reload
            },
        });
    }
};
</script>

<template>
    <Head title="Edit Booking" />
    <div class="min-h-full p-6 bg-gradient-to-b from-sky-400 to-blue-600">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white/20 backdrop-blur-sm shadow-xl rounded-lg border border-white/50 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">
                        Edit Booking
                    </h2>
                </div>
                <form @submit.prevent="updateBooking" class="space-y-6">
                    <div>
                        <label for="nama_pemesan" class="block text-sm font-medium text-white">Nama Pemesan</label>
                        <input
                            id="nama_pemesan"
                            v-model="form.nama_pemesan"
                            type="text"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <div>
                        <label for="tanggal_booking" class="block text-sm font-medium text-white">Tanggal Booking</label>
                        <input
                            id="tanggal_booking"
                            v-model="form.tanggal_booking"
                            type="date"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <div>
                        <label for="jam_booking" class="block text-sm font-medium text-white">Jam Booking</label>
                        <input
                            id="jam_booking"
                            v-model="form.jam_booking"
                            type="time"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <div>
                        <label for="nomor_meja" class="block text-sm font-medium text-white">Nomor HP</label>
                        <input
                            id="nomor_meja"
                            v-model="form.nomor_meja"
                            type="text"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Items</label>
                        <ul class="bg-white/10 rounded p-2">
                            <li v-for="item in items" :key="item.id" class="flex flex-col md:flex-row md:items-center md:justify-between py-1 gap-2">
                                <div class="flex-1 flex flex-col md:flex-row md:items-center gap-2">
                                    <select v-model="item.menu_name" class="w-32 px-2 py-1 rounded bg-white/20 text-white border border-white/30">
                                        <option v-for="menu in menus" :key="menu.id" :value="menu.name">{{ menu.name }}</option>
                                    </select>
                                    <input v-model.number="item.quantity" type="number" min="1" class="w-16 px-2 py-1 rounded bg-white/20 text-white border border-white/30" />
                                    <input v-model.number="item.price" type="number" min="0" class="w-24 px-2 py-1 rounded bg-white/20 text-white border border-white/30" />
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" @click="updateItem(item)" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">Simpan</button>
                                    <button type="button" @click="deleteItem(item)" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">Hapus</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
