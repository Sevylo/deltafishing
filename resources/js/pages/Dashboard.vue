<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import UserCharts from '../components/Charts/UserChart.vue';
import { UsersIcon, CalendarDaysIcon, ShoppingCartIcon, FishIcon } from 'lucide-vue-next';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import Chart from 'chart.js/auto';

interface ChartTrend {
    date: string;
    count: number;
}

interface ChartTotals {
    users: number;
    events: number;
    orders: number;
    sewa: number;
}

interface Stat {
    name: string;
    value: string | number;
    change: string;
    changeType: 'positive' | 'negative';
    icon: string;
}

interface Props {
    stats: Stat[];
    chartData: {
        userTrends: ChartTrend[];
        totals: ChartTotals;
    };
}

const props = defineProps<Props>();

const iconComponents = {
    UsersIcon,
    CalendarDaysIcon,
    ShoppingCartIcon,
    FishIcon
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const trendChart = ref<HTMLCanvasElement | null>(null);
let trendChartInstance: Chart | null = null;

const initTrendChart = () => {
    // Clean up existing chart if it exists
    if (trendChartInstance) {
        trendChartInstance.destroy();
        trendChartInstance = null;
    }

    if (trendChart.value && props.chartData.userTrends) {
        const ctx = trendChart.value.getContext('2d');
        if (!ctx) return;

        trendChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: props.chartData.userTrends.map(d => d.date),
                datasets: [{
                    label: 'New Users',
                    data: props.chartData.userTrends.map(d => d.count),
                    borderColor: 'rgb(255, 255, 255)',
                    backgroundColor: 'rgba(255, 255, 255, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                animation: {
                    duration: 0 // Disable animations for better performance
                },
                responsive: true,
                maintainAspectRatio: true, // Set to true to prevent layout shifts
                aspectRatio: 2, // Set a fixed aspect ratio
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)',
                            maxRotation: 0, // Prevent label rotation
                            autoSkip: true, // Skip labels that would overlap
                            maxTicksLimit: 8 // Limit the number of ticks for better readability
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'rgba(255, 255, 255, 0.9)'
                        }
                    }
                }
            }
        });
    }
};

onMounted(() => {
    initTrendChart();
});

onBeforeUnmount(() => {
    if (trendChartInstance) {
        trendChartInstance.destroy();
        trendChartInstance = null;
    }
});

// Mock data for recent activities
const recentActivities = [
    {
        id: 1,
        user: 'Budi Santoso',
        action: 'memesan alat pancing',
        time: '5 menit yang lalu',
    },
    {
        id: 2,
        user: 'Diana Putri',
        action: 'mendaftar event memancing',
        time: '15 menit yang lalu',
    },
    {
        id: 3,
        user: 'Ahmad Rahman',
        action: 'menyewa kolam',
        time: '1 jam yang lalu',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4 bg-gradient-to-b from-sky-400 to-blue-600">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div v-for="stat in props.stats" :key="stat.name" 
                     class="relative overflow-hidden rounded-xl border border-white/20 bg-white/10 backdrop-blur-sm p-6">
                    <component :is="iconComponents[stat.icon as keyof typeof iconComponents]" class="h-8 w-8 text-white/80" />
                    <p class="mt-2 text-sm font-medium text-white/60">{{ stat.name }}</p>
                    <p class="mt-1 text-3xl font-semibold text-white">{{ stat.value }}</p>
                    <span :class="[
                        'mt-1 text-sm font-medium',
                        stat.changeType === 'positive' ? 'text-green-400' : 'text-red-400'
                    ]">
                        {{ stat.change }}
                    </span>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-white/20 bg-white/10 backdrop-blur-lg h-[400px]">
                    <UserCharts :data="chartData.totals" />
                </div>
                <div class="relative overflow-hidden rounded-xl border border-white/20 bg-white/10 backdrop-blur-sm p-4 h-[400px]">
                    <h2 class="text-xl font-semibold mb-4 text-white">User Registration Trend</h2>
                    <div class="h-[calc(100%-2rem)]">
                        <canvas ref="trendChart"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </AppLayout>
</template>
