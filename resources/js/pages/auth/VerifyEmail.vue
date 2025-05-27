<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};
</script>

<template>
    <AuthLayout title="Verify email" description="Please verify your email address by clicking on the link we just emailed to you.">
        <Head title="Email verification" />

        <div v-if="status === 'verification-link-sent'" class="status-message">
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <form @submit.prevent="submit" class="verify-form">
            <Button :disabled="form.processing" variant="secondary">
                <LoaderCircle v-if="form.processing" class="spinner" />
                Resend verification email
            </Button>

            <TextLink :href="route('logout')" method="post" as="button" class="logout-link">
                Log out
            </TextLink>
        </form>
    </AuthLayout>
</template>

<style scoped>
.status-message {
    margin-bottom: 1rem;
    text-align: center;
    font-size: 0.875rem;
    font-weight: 500;
    color: #16a34a;
}

.verify-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    text-align: center;
}

.logout-link {
    display: block;
    margin: 0 auto;
    font-size: 0.875rem;
}

.spinner {
    width: 1rem;
    height: 1rem;
    animation: spin 1s linear infinite;
    margin-right: 0.5rem;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
