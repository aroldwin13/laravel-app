<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { MoonIcon, SunIcon } from "@heroicons/vue/outline";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Button from "@/Components/Button.vue";
import { toggleDarkMode, isDark } from "@/Composables";

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title" />

    <div
        class="flex flex-col items-center justify-center min-h-screen gap-4 py-6"
        :style="{
            backgroundImage: 'url(images/mmsubg.jpg)',
            backgroundPosition: 'center center',
            backgroundAttachment: 'fixed',
        }"
    >
        <main class="w-full sm:max-w-md mx-auto">
            <div class="bg-white rounded-t-lg dark:bg-dark-eval-1 p-4">
                <div class="flex items-center justify-left">
                    <!-- Logo icon or image -->
                    <Link href="/">
                        <ApplicationLogo class="w-20 h-20" />
                    </Link>

                    <!-- System name -->
                    <div class="ml-4">
                        <h1
                            class="text-2xl font-bold text-gray-800 dark:text-white"
                            style="font-family: Garamond"
                        >
                            RESEARCH INDEX AND
                        </h1>
                        <h1
                            class="text-2xl font-bold text-gray-800 dark:text-white"
                            style="font-family: Garamond"
                        >
                            ABSTRACTING SYSTEM
                        </h1>
                    </div>
                </div>
            </div>
            <div
                class="bg-white shadow-md rounded-b-lg dark:bg-dark-eval-1 p-4"
            >
                <!-- Other content goes here -->
                <slot />
            </div>
        </main>

        <div class="fixed right-10 top-10">
            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleDarkMode"
                v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex"
                srText="Toggle dark mode"
            >
                <MoonIcon
                    v-show="!isDark"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
                <SunIcon
                    v-show="isDark"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
            </Button>
        </div>
    </div>
</template>
