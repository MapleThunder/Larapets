<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase title="Log in to your account" description="Enter your email and password below to log in">
        <Head title="Log in" />

        <div v-if="status" class="status-message">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="login-form">
            <div class="form-fields">
                <div class="form-field">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="form-field">
                    <div class="field-label">
                        <Label for="password">Password</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')" class="forgot-link" :tabindex="5">
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="remember-me">
                    <Label for="remember" class="remember-label">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button type="submit" class="submit-button" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="spinner" />
                    Log in
                </Button>
            </div>

            <div class="form-footer">
                Don't have an account?
                <TextLink :href="route('register')" :tabindex="5">Sign up</TextLink>
            </div>
        </form>
    </AuthBase>
</template>

<style scoped>
.status-message {
    margin-bottom: 1rem;
    text-align: center;
    font-size: 0.875rem;
    font-weight: 500;
    color: #16a34a;
}

.login-form {
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

.field-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.forgot-link {
    font-size: 0.875rem;
}

.remember-me {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.remember-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
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

.form-footer {
    text-align: center;
    font-size: 0.875rem;
    color: var(--muted-foreground, #6b7280);
}

.form-footer span {
    margin-right: 0.25rem;
}
</style>
