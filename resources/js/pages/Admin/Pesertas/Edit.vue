<script>
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
export default {
    layout: AppSidebarLayout,
};
</script>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    peserta: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    name: props.peserta.name,
    email: props.peserta.email,
    phone: props.peserta.phone || '',
});
const submit = () => {
    form.put(route('pesertas.update', props.peserta.id), {
        preserveScroll: true,
        onSuccess: () => {
            window.location.href = route('pesertas.index');
        },
    });
};
</script>

<template>
    <Head title="Edit Peserta" />
    <div class="min-h-full p-6 bg-gradient-to-b from-sky-400 to-blue-600">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white/20 backdrop-blur-sm shadow-xl rounded-lg border border-white/50 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">
                        Edit Peserta
                    </h2>
                </div>
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-white">Nama</label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-white">NO Telepon</label>
                        <input
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/30 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
