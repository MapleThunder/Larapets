<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: '/settings/profile',
    },
    {
        title: 'Password',
        href: '/settings/password',
    },
    {
        title: 'Appearance',
        href: '/settings/appearance',
    },
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="settings-layout">
        <Heading title="Settings" description="Manage your profile and account settings" />

        <div class="settings-content">
            <aside class="sidebar">
                <nav class="nav-links">
                    <Button
                        v-for="item in sidebarNavItems"
                        :key="item.href"
                        variant="ghost"
                        :class="['nav-button', { 'active': currentPath === item.href }]"
                        as-child
                    >
                        <Link :href="item.href">
                            {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="separator" />

            <div class="main-content">
                <section class="slot-section">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>

<style scoped>
.settings-layout {
    padding: 1.5rem 1rem;
}

.settings-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

@media (min-width: 1024px) {
    .settings-content {
        flex-direction: row;
        gap: 3rem;
    }
}

.sidebar {
    width: 100%;
    max-width: 100%;
}

@media (min-width: 1024px) {
    .sidebar {
        width: 12rem;
        max-width: none;
    }
}

.nav-links {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.nav-button {
    width: 100%;
    justify-content: flex-start;
}

.nav-button.active {
    background-color: var(--muted-bg, #f3f4f6);
}

.separator {
    margin: 1.5rem 0;
    display: block;
}

@media (min-width: 768px) {
    .separator {
        display: none;
    }
}

.main-content {
    flex: 1;
    max-width: 42rem;
}

.slot-section {
    max-width: 36rem;
    display: flex;
    flex-direction: column;
    gap: 3rem;
}
</style>