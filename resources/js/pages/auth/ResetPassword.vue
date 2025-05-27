<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <AuthLayout title="Reset password" description="Please enter your new password below">
        <Head title="Reset password" />

        <form @submit.prevent="submit" class="reset-form">
            <div class="form-fields">
                <div class="form-field">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" name="email" autocomplete="email" v-model="form.email" readonly class="input" />
                    <InputError :message="form.errors.email" class="input-error" />
                </div>

                <div class="form-field">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        v-model="form.password"
                        autofocus
                        placeholder="Password"
                        class="input"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="form-field">
                    <Label for="password_confirmation">Confirm Password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                        class="input"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="submit-button" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="spinner" />
                    Reset password
                </Button>
            </div>
        </form>
    </AuthLayout>
</template>

<style scoped>
.reset-form {
    width: 100%;
}

.form-fields {
    display: grid;
    gap: 1.5rem;
}

.form-field {
    display: grid;
    gap: 0.5rem;
}

.input {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
}

.input-error {
    margin-top: 0.5rem;
}

.submit-button {
    margin-top: 1rem;
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