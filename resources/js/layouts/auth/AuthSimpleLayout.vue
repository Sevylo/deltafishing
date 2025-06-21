<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="flex min-h-svh flex-col items-center justify-center bg-gradient-to-b from-sky-400 via-blue-500 to-blue-700 p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <Link :href="route('home')" class="flex flex-col items-center gap-2 font-medium">
                        <div class="mb-1 flex h-9 w-9 items-center justify-center rounded-md bg-white/10 backdrop-blur-sm">
                            <AppLogoIcon class="size-9 fill-current text-white" />
                        </div>
                        <span class="sr-only">{{ title }}</span>
                    </Link>
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium text-white">{{ title }}</h1>
                        <p class="text-center text-sm text-blue-50">{{ description }}</p>
                    </div>
                </div>
                <div class="rounded-lg bg-white/40 p-6 backdrop-blur-sm">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<style>
:root {
    --background: transparent;
    --foreground: rgb(255 255 255);
    --muted: rgb(255 255 255 / 0.1);
    --muted-foreground: rgb(255 255 255 / 0.7);
    --border: rgb(255 255 255 / 0.2);
    --input: rgb(255 255 255 / 0.1);
    --ring: rgb(255 255 255);
}
</style>
