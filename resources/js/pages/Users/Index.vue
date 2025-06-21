<script>
// Blok script ini sudah benar untuk mendefinisikan layout
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';

export default {
    layout: AppSidebarLayout,
};
</script>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const deleteUser = (userId) => {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(route('users.destroy', userId), {
            preserveScroll: true,
            onSuccess: () => {
                router.visit(route('users.index', { page: 1 }));
            }
        });
    }
};
</script>

<template>
    <Head title="Master User" />
    
    <div class="min-h-full p-6 bg-gradient-to-b from-sky-400 to-blue-600">
        <div class="bg-white/20 backdrop-blur-sm shadow-xl rounded-lg border border-white/50 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl text-white leading-tight">
                    Master Data User
                </h2>
            </div>
        
            <div class="overflow-x-auto">
                <table v-if="users.data.length > 0" class="min-w-full divide-y divide-white/20">
                    <thead class="bg-white/5">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Phone Number</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white/70 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/40">
                        <tr v-for="user in users.data" :key="user.id" class="hover:bg-white/5">
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ user.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ user.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white">{{ user.phone || '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white space-x-2">
                                <Link 
                                    :href="route('users.edit', user.id)"
                                    class="inline-flex items-center px-3 py-1.5 border border-white/30 rounded-md text-sm text-white hover:bg-white/10 transition-colors duration-200"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </Link>
                                <button
                                    @click="deleteUser(user.id)"
                                    class="inline-flex items-center px-3 py-1.5 border border-red-500/30 rounded-md text-sm text-red-400 hover:bg-red-500/10 transition-colors duration-200"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div v-else class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-4">
                        <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white mb-1">No Users Found</h3>
                    <p class="text-white/70">It seems there are no registered users at the moment.</p>
                </div>

                <div v-if="users.data.length > 0" class="mt-6 flex items-center justify-between border-t border-white/20 px-4 py-3 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden">                        <component
                            :is="users.prev_page_url ? Link : 'span'"
                            :href="users.prev_page_url || undefined"
                            class="relative inline-flex items-center rounded-md border border-white/20 bg-white/5 px-4 py-2 text-sm font-medium text-white hover:bg-white/10 disabled:opacity-50 disabled:cursor-not-allowed"
                            :class="{ 'opacity-50 cursor-not-allowed': !users.prev_page_url }"
                        >
                            Previous
                        </component>
                        <component
                            :is="users.next_page_url ? Link : 'span'"
                            :href="users.next_page_url || undefined"
                            class="relative ml-3 inline-flex items-center rounded-md border border-white/20 bg-white/5 px-4 py-2 text-sm font-medium text-white hover:bg-white/10 disabled:opacity-50 disabled:cursor-not-allowed"
                            :class="{ 'opacity-50 cursor-not-allowed': !users.next_page_url }"
                        >
                            Next
                        </component>
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-white">
                                Showing
                                <span class="font-medium">{{ users.from }}</span>
                                to
                                <span class="font-medium">{{ users.to }}</span>
                                of
                                <span class="font-medium">{{ users.total }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">                                <component
                                    :is="link.url ? Link : 'span'"
                                    v-for="(link, key) in users.links"
                                    :key="key"
                                    :href="link.url || undefined"
                                    v-html="link.label"
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white hover:bg-white/10 focus:z-20 focus:outline-offset-0"
                                    :class="[
                                        link.url === null ? 'cursor-not-allowed opacity-50' : '',
                                        link.active ? 'bg-white/10 text-white' : 'text-white/70',
                                        key === 0 ? 'rounded-l-md' : '',
                                        key === users.links.length - 1 ? 'rounded-r-md' : '',
                                    ]"
                                />
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>