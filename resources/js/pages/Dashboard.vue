<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="dashboard-container">
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <PlaceholderPattern />
                </div>
                <div class="dashboard-card">
                    <PlaceholderPattern />
                </div>
                <div class="dashboard-card">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="dashboard-full">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.dashboard-container {
    display: flex;
    flex-direction: column;
    flex: 1;
    height: 100%;
    gap: 1rem;
    border-radius: 0.75rem;
    padding: 1rem;
}

.dashboard-grid {
    display: grid;
    gap: 1rem;
    grid-auto-rows: min-content;
}

@media (min-width: 768px) {
    .dashboard-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.dashboard-card {
    position: relative;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    border-radius: 0.75rem;
    border: 1px solid var(--sidebar-border, #ccc);
}

.dashboard-full {
    position: relative;
    flex: 1;
    min-height: 100vh;
    border-radius: 0.75rem;
    border: 1px solid var(--sidebar-border, #ccc);
}

@media (min-width: 768px) {
    .dashboard-full {
        min-height: auto;
    }
}
</style>
