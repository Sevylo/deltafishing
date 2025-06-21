<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import type { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Database, Home } from 'lucide-vue-next'; 
import AppLogo from './AppLogo.vue';

// 2. MODIFIKASI: Tambahkan objek baru untuk "Master Data" dengan properti "children"
const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title:'Homepage',
        icon: Home,
        href: '/',
    },
    {
        title: 'Master Data',
        icon: Database, 
        children: [
            {
                title: 'Users',
                href: '/users', // Pastikan route ini sudah ada di web.php
                
            },
            {
                title:'Booking',
                href: '/admin/bookings', // Pastikan route ini sudah ada di web.php
            },
            {
                title:'Peserta Event',
                href: '/pesertas', // Pastikan route ini sudah ada di web.php
            },
            
            // Anda bisa menambah sub-menu lain di sini
            // {
            //  title: 'Produk',
            //  href: '/products',
            // },
        ],
    },
];

const footerNavItems: NavItem[] = [];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>