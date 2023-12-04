<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import SidebarLink from "@/Components/Sidebar/SidebarLink.vue";
import { SubmissionIcon, HomeIcon, AddIcon } from "@/Components/Icons/outline";

const props = defineProps({
    submissions: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("submissions.destroy", id));
    }
}
</script>

<template>
    <AuthenticatedLayout title="Submission">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Your Submission</h2>
            </div>
        </template>
        <div class="p-4 overflow-hidden bg-gray-100 rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex justify-end">
                <Button variant="success" class="block text-white bg-blue-700 hover:bg-blue-800 cursor-pointer" :href="route('submissions.create')" :active="route().current('submissions.create')">
                    Add Thesis
                </Button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-mmsu-color dark:bg-gray-700 dark:text-gray-400 shadow-md sm:rounded-lg" 
                            style="border-bottom: 3px solid #ffcd00">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">College</th>
                            <th scope="col" class="px-6 py-3">Pub. Year</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(submission, index) in props.submissions" :key="submission.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ submission.title }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ submission.shortabs }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ submission.created_at }}
                            </td>
                            <td class="px-6 py-4 flex items-center">
                                <Button variant="info">View</Button>&nbsp;
                                <Button variant="info">
                                    <Link :href="route('submissions.edit', submission.id)">Edit</Link>
                                </Button>&nbsp;
                                <Button variant="danger" @click="destroy(submission.id)">Delete</Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
