<script setup lang="ts">
// 1. HAPUS NavLink, TAMBAHKAN komponen yang benar
import { SidebarMenuItem, SidebarMenuButton } from '@/components/ui/sidebar';
import type { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Terima 'items' sebagai prop dari AppSidebar.vue
defineProps<{
    items: NavItem[];
}>();

// State untuk melacak menu dropdown mana yang sedang terbuka (logika ini tetap sama)
const openMenus = ref<Record<string, boolean>>({});

// Fungsi untuk membuka/menutup dropdown (logika ini tetap sama)
function toggleMenu(title: string) {
    openMenus.value[title] = !openMenus.value[title];
}
</script>

<template>
    <nav>
        <ul class="space-y-2 font-medium">
            <li v-for="item in items" :key="item.title">

                <SidebarMenuItem v-if="!item.children">
                    <SidebarMenuButton as-child class="w-full">
                        <Link :href="item.href!">
                            <component :is="item.icon" v-if="item.icon" class="w-5 h-5" />
                            <span class="ms-3">{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>

                <div v-else>
                    <SidebarMenuItem>
                        <SidebarMenuButton @click="toggleMenu(item.title)" class="w-full">
                            <component :is="item.icon" v-if="item.icon" class="w-5 h-5" />
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ item.title }}</span>
                            <svg
                                class="w-3 h-3 transition-transform duration-200"
                                :class="{'rotate-180': openMenus[item.title]}"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 10 6"
                            >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                    
                    <ul v-if="openMenus[item.title]" class="py-2 space-y-1 ps-4">
                        <li v-for="child in item.children" :key="child.title">
                            <SidebarMenuItem>
                                <SidebarMenuButton as-child class="w-full justify-start">
                                    <Link :href="child.href!">
                                        {{ child.title }}
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</template>