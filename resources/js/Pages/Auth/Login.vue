<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { MailIcon, LockClosedIcon } from "@heroicons/vue/outline";
import InputIconWrapper from "@/Components/InputIconWrapper.vue";
import Button from "@/Components/Button.vue";
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Inertia } from "@inertiajs/inertia";
import { MyCustomLoginIcon } from "@/Components/Icons/outline";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            // Reset the password field
            form.reset("password");
        },
    });
};
</script>

<template>
    <GuestLayout title="Archive System">
        <ValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="email" value="Email" />
                    <InputIconWrapper>
                        <template #icon>
                            <MailIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input
                            withIcon
                            id="email"
                            type="email"
                            class="block w-full border border-gray-300 rounded-md px-3 py-2"
                            placeholder="Email"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="email"
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
                            autocomplete="current-password"
                        />
                    </InputIconWrapper>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox
                            name="remember"
                            v-model:checked="form.remember"
                        />
                        <span class="ml-2 text-sm text-gray-600"
                            >Remember me</span
                        >
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-blue-500 hover:underline"
                    >
                        Forgot your password?
                    </Link>
                </div>

                <div>
                    <Button
                        class="justify-center w-full gap-2"
                        :disabled="form.processing"
                        v-slot="{ iconSizeClasses }"
                    >
                        <span>Log in</span>
                        <MyCustomLoginIcon
                            aria-hidden="true"
                            :class="iconSizeClasses"
                        />
                    </Button>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
