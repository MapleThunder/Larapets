<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AuthLayout title="Forgot password" description="Enter your email to receive a password reset link">
        <Head title="Forgot password" />

        <div v-if="status" class="status-message">
            {{ status }}
        </div>

        <div class="form-wrapper">
            <form @submit.prevent="submit">
                <div class="form-field">
                    <Label for="email">Email address</Label>
                    <Input id="email" type="email" name="email" autocomplete="off" v-model="form.email" autofocus placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="form-action">
                    <Button class="submit-button" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="spinner" />
                        Email password reset link
                    </Button>
                </div>
            </form>

            <div class="form-footer">
                <span>Or, return to</span>
                <TextLink :href="route('login')">log in</TextLink>
            </div>
        </div>
    </AuthLayout>
</template>

<style scoped>
.status-message {
    margin-bottom: 1rem;
    text-align: center;
    font-size: 0.875rem;
    font-weight: 500;
    color: #16a34a; /* green-600 */
}

.form-wrapper {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-field {
    display: grid;
    gap: 0.5rem;
}

.form-action {
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.submit-button {
    width: 100%;
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

.form-footer {
    text-align: center;
    font-size: 0.875rem;
    color: var(--muted-foreground, #6b7280);
}

.form-footer span {
    margin-right: 0.25rem;
}
</style>
