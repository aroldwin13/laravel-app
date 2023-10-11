<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { sidebarState } from '@/Composables'
import { EmptyCircleIcon } from '@/Components/Icons/outline'

import { defineProps } from 'vue'

const props = defineProps({
    href: {
        type: String,
        default: null,
    },
    active: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
        required: true,
    },
    external: {
        type: Boolean,
        default: false,
    },
})

const Tag = !props.external ? Link : 'a'
</script>

<template>
    <component
        :is="Tag"
        v-if="href"
        :href="href"
        style="border-bottom: 3px solid #ffcd00;"
        :class="[
            'p-2 flex items-center gap-2 rounded-md transition-colors',
            {
                'text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-dark-eval-2': !active,
                'text-gray-500 bg-mmsu-color shadow-lg hover:bg-gray-100': active,
            },
        ]"
        :style="{'border-color': active ? '#ffcd00' : 'transparent'}"
    >
        <slot name="icon">
            <EmptyCircleIcon aria-hidden="true" class="flex-shrink-0 w-6 h-6" />
        </slot>
        <span class="text-base font-medium">
            {{ title }}
        </span>
    </component>

    <button
        v-else
        type="button"
        :class="[
            'p-2 w-full flex items-center gap-2 rounded-md transition-colors',
            {
                'text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-dark-eval-2': !active,
                'text-white bg-mmsu-color shadow-lg hover:bg-green-600': active,
            },
        ]"
    >
        <slot name="icon">
            <EmptyCircleIcon aria-hidden="true" class="flex-shrink-0 w-6 h-6" />
        </slot>
        <span class="text-base font-medium" v-show="sidebarState.isOpen || sidebarState.isHovered">
            {{ title }}
        </span>
        <slot name="arrow" />
    </button>
</template>
