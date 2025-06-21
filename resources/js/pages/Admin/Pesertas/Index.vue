<script>
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
export default {
    layout: AppSidebarLayout,
};
</script>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
const props = defineProps({
    pesertas: {
        type: Object,
        required: true,
    },
});
const deletePeserta = (id) => {
    if (confirm('Hapus peserta ini?')) {
        router.delete(route('pesertas.destroy', id));
    }
};
</script>

<template>
    <Head title="Master Peserta" />
    <div class="min-h-full p-6 bg-gradient-to-b from-sky-400 to-blue-600">
        <div class="bg-white/20 backdrop-blur-sm shadow-xl rounded-lg border border-white/50 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl text-white leading-tight">
                    Master Data Peserta
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table v-if="pesertas.data.length > 0" class="min-w-full divide-y divide-white/20">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/40">
                        <tr v-for="peserta in pesertas.data" :key="peserta.id" class="hover:bg-white/5">
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ peserta.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ peserta.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ peserta.phone || '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white space-x-2">
                                <Link :href="route('pesertas.edit', peserta.id)" class="inline-flex items-center px-3 py-1.5 border border-white/30 rounded-md text-sm text-white hover:bg-white/10 transition-colors duration-200">Edit</Link>
                                <button @click="deletePeserta(peserta.id)" class="inline-flex items-center px-3 py-1.5 border border-red-400 rounded-md text-sm text-red-200 hover:bg-red-600/30 transition-colors duration-200">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="text-white/80 py-8 text-center">Tidak ada data peserta.</div>
            </div>
        </div>
    </div>
</template>
