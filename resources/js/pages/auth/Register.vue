<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="Create an account" description="Enter your details below to create your account">
        <Head title="Register" />

        <form @submit.prevent="submit" class="register-form">
            <div class="form-fields">
                <div class="form-field">
                    <Label for="name">Name</Label>
                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="form-field">
                    <Label for="email">Email address</Label>
                    <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="form-field">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="form-field">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="submit-button" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="spinner" />
                    Create account
                </Button>
            </div>

            <div class="form-footer">
                Already have an account?
                <TextLink :href="route('login')" class="login-link" :tabindex="6">Log in</TextLink>
            </div>
        </form>
    </AuthBase>
</template>

<style scoped>
.register-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-fields {
    display: grid;
    gap: 1.5rem;
}

.form-field {
    display: grid;
    gap: 0.5rem;
}

.submit-button {
    margin-top: 0.5rem;
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

.login-link {
    text-decoration: underline;
    text-underline-offset: 4px;
    margin-left: 0.25rem;
}
</style>
