<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const name = page.props.name;
const quote = page.props.quote;

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="auth-layout">
        <div class="auth-sidebar">
            <div class="sidebar-background" />
            <Link :href="route('home')" class="logo-link">
                <AppLogoIcon class="logo-icon" />
                {{ name }}
            </Link>
            <div v-if="quote" class="quote-wrapper">
                <blockquote class="quote">
                    <p class="quote-message">&ldquo;{{ quote.message }}&rdquo;</p>
                    <footer class="quote-author">{{ quote.author }}</footer>
                </blockquote>
            </div>
        </div>

        <div class="auth-main">
            <div class="auth-form-wrapper">
                <div class="form-header">
                    <h1 v-if="title" class="form-title">{{ title }}</h1>
                    <p v-if="description" class="form-description">{{ description }}</p>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
.auth-layout {
    display: grid;
    grid-template-columns: 1fr;
    height: 100dvh;
    padding-left: 2rem;
    padding-right: 2rem;
}

@media (min-width: 1024px) {
    .auth-layout {
        grid-template-columns: 1fr 1fr;
        padding: 0;
    }
}

.auth-sidebar {
    display: none;
    flex-direction: column;
    background-color: var(--muted-bg, #1f2937);
    padding: 2.5rem;
    color: white;
    position: relative;
}

@media (min-width: 1024px) {
    .auth-sidebar {
        display: flex;
        height: 100%;
        border-right: 1px solid var(--border-color, #2d2d2d);
    }
}

.sidebar-background {
    position: absolute;
    inset: 0;
    background-color: #18181b;
    z-index: 0;
}

.logo-link {
    position: relative;
    z-index: 10;
    display: flex;
    align-items: center;
    font-size: 1.125rem;
    font-weight: 500;
    color: white;
    text-decoration: none;
}

.logo-icon {
    margin-right: 0.5rem;
    width: 2rem;
    height: 2rem;
    fill: currentColor;
}

.quote-wrapper {
    margin-top: auto;
    position: relative;
    z-index: 10;
}

.quote {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.quote-message {
    font-size: 1.125rem;
}

.quote-author {
    font-size: 0.875rem;
    color: #d4d4d8;
}

.auth-main {
    padding: 2rem;
}

@media (min-width: 1024px) {
    .auth-main {
        padding: 2rem;
    }
}

.auth-form-wrapper {
    margin: 0 auto;
    width: 100%;
    max-width: 350px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1.5rem;
}

.form-header {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    text-align: center;
}

.form-title {
    font-size: 1.25rem;
    font-weight: 500;
    letter-spacing: -0.01em;
}

.form-description {
    font-size: 0.875rem;
    color: var(--muted-foreground, #6b7280);
}
</style>