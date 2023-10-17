<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import {
    UserIcon,
    MailIcon,
    LockClosedIcon,
    UserAddIcon,
} from "@heroicons/vue/outline";
import GuestLayout from "@/Layouts/Guest.vue";
import InputIconWrapper from "@/Components/InputIconWrapper.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import Button from "@/Components/Button.vue";

const form = useForm({
    firstname: "",
    surname: "",
    role: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout title="Register">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="firstname" value="Firstname" />
                    <InputIconWrapper>
                        <template #icon>
                            <UserIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input
                            withIcon
                            id="firstname"
                            type="text"
                            placeholder="firstname"
                            class="block w-full"
                            v-model="form.firstname"
                            required
                            autofocus
                            autocomplete="firstname"
                        />
                    </InputIconWrapper>
                </div>
                <div class="space-y-2">
                    <Label for="surname" value="Surname" />
                    <InputIconWrapper>
                        <template #icon>
                            <UserIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input
                            withIcon
                            id="surname"
                            type="text"
                            placeholder="surname"
                            class="block w-full"
                            v-model="form.surname"
                            required
                            autofocus
                            autocomplete="surname"
                        />
                    </InputIconWrapper>
                </div>
                <div class="space-y-2">
                    <Label for="role" value="Role" />
                    <InputIconWrapper>
                        <template #icon>
                            <UserIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input
                            withIcon
                            id="role"
                            type="text"
                            placeholder="role"
                            class="block w-full"
                            v-model="form.role"
                            required
                            autofocus
                            autocomplete="role"
                        />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password" value="Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon
                                aria-hidden="true"
                                class="w-5 h-5"
                            />
                        </template>
                        <Input
                            withIcon
                            id="password"
                            type="password"
                            class="block w-full"
                            placeholder="Password"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon
                                aria-hidden="true"
                                class="w-5 h-5"
                            />
                        </template>
                        <Input
                            withIcon
                            id="password_confirmation"
                            type="password"
                            class="block w-full"
                            placeholder="Confirm Password"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                    </InputIconWrapper>
                </div>

                <div>
                    <Button
                        class="justify-center gap-2 w-full"
                        :disabled="form.processing"
                        v-slot="{ iconSizeClasses }"
                    >
                        <UserAddIcon
                            aria-hidden="true"
                            :class="iconSizeClasses"
                        />
                        <span>Register</span>
                    </Button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <Link
                        :href="route('login')"
                        class="text-blue-500 hover:underline"
                    >
                        Login
                    </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
