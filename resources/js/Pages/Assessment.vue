<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { GithubIcon } from "@/Components/Icons/brands";
</script>

<template>
    <AuthenticatedLayout title="Assessment">
        <template #header>
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <h2 class="text-xl font-semibold leading-tight">
                    You are in Assessment
                </h2>
            </div>
        </template>

        <div
            class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1"
        >
            Welcome Assessment
        </div>
    </AuthenticatedLayout>
</template>
