<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="auth-card-layout">
        <div class="card-wrapper">
            <div class="card-content">
                <div class="card-header">
                    <Link :href="route('home')" class="logo-link">
                        <div class="logo-container">
                            <AppLogoIcon class="logo-icon" />
                        </div>
                        <span class="sr-only">{{ title }}</span>
                    </Link>
                    <div class="text-center">
                        <h1 class="card-title">{{ title }}</h1>
                        <p class="card-description">{{ description }}</p>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
.auth-card-layout {
    display: flex;
    min-height: 100svh;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    background-color: var(--background, #fff);
    padding: 1.5rem;
}

@media (min-width: 768px) {
    .auth-card-layout {
        padding: 2.5rem;
    }
}

.card-wrapper {
    width: 100%;
    max-width: 24rem; /* max-w-sm */
}

.card-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.card-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.logo-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    text-decoration: none;
}

.logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 2.25rem;
    width: 2.25rem;
    border-radius: 0.375rem;
}

.logo-icon {
    width: 2.25rem;
    height: 2.25rem;
    fill: currentColor;
    color: var(--foreground, #000);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 500;
}

.card-description {
    font-size: 0.875rem;
    color: var(--muted-foreground, #6b7280);
}
</style>
