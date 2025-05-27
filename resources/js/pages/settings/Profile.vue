<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="profile-settings">
                <HeadingSmall title="Profile information" description="Update your name and email address" />

                <form @submit.prevent="submit" class="form">
                    <div class="form-field">
                        <Label for="name">Name</Label>
                        <Input id="name" v-model="form.name" required autocomplete="name" placeholder="Full name" class="input" />
                        <InputError class="input-error" :message="form.errors.name" />
                    </div>

                    <div class="form-field">
                        <Label for="email">Email address</Label>
                        <Input id="email" type="email" v-model="form.email" required autocomplete="username" placeholder="Email address" class="input" />
                        <InputError class="input-error" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at" class="verify-block">
                        <p class="verify-hint">
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="verify-link"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </p>
                        <div v-if="status === 'verification-link-sent'" class="verify-status">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>

                    <div class="form-actions">
                        <Button :disabled="form.processing">Save</Button>
                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="success-message">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>

            <DeleteUser />
        </SettingsLayout>
    </AppLayout>
</template>

<style scoped>
.profile-settings {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form {
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
    width: 100%;
}

.input-error {
    margin-top: 0.5rem;
}

.verify-block {
    margin-top: -1rem;
    font-size: 0.875rem;
    color: var(--muted-foreground, #6b7280);
}

.verify-hint {
    margin-bottom: 0.5rem;
}

.verify-link {
    text-decoration: underline;
    text-underline-offset: 4px;
    color: inherit;
    transition: color 0.3s ease-out;
}

.verify-status {
    font-weight: 500;
    color: #16a34a;
}

.form-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.success-message {
    font-size: 0.875rem;
    color: #4b5563; /* neutral-600 */
}
</style>
