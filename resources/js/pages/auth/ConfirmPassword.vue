<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AuthLayout title="Confirm your password" description="This is a secure area of the application. Please confirm your password before continuing.">
        <Head title="Confirm password" />

        <form @submit.prevent="submit" class="confirm-form">
            <div class="form-group">
                <div class="form-field">
                    <Label htmlFor="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                        class="input"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="form-action">
                    <Button class="submit-button" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="spinner" />
                        Confirm Password
                    </Button>
                </div>
            </div>
        </form>
    </AuthLayout>
</template>

<style scoped>
.confirm-form {
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-field {
    display: grid;
    gap: 0.5rem;
}

.input {
    margin-top: 0.25rem;
    display: block;
    width: 100%;
}

.form-action {
    display: flex;
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
</style>
