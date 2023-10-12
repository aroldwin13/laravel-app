<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Button from '@/Components/Button.vue';
import { GithubIcon } from '@/Components/Icons/brands';
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue';
import { SubmissionIcon, HomeIcon, } from '@/Components/Icons/outline';

const props = defineProps({
  submissions: {
    type: Array,
    default: () => [],
  },
});

const sortedSubmissions = props.submissions.slice().sort((a, b) => a.id - b.id);

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
        <h2 class="text-xl font-semibold leading-tight">
          You are in Home
        </h2>
      </div>
    </template>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
      <div class="mb-4">
        <button class="bg-mmsu-color rounded-lg">
          <SidebarLink
            title="Add Thesis"
            :href="route('submissions.create')"
            :active="route().current('submissions.create')"
          >
            <template #icon>
              <SubmissionIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>
          </SidebarLink>
        </button>
      </div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">#</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3"></th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(submission, index) in sortedSubmissions" :key="submission.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ index + 1 }}</td>
              <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ submission.title }}</td>
              <td class="px-6 py-4"></td>
              <td class="px-6 py-4 flex items-center">
                <Button variant="success">View</Button>
                <Button variant="info">
                  <Link :href="route('submissions.edit', submission.id)">Edit</Link>
                </Button>
                <!-- <Button variant="danger" @click="destroy(blog.id)">Delete</Button> -->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
>>>>>>> 05823a46 (friday finish Product)
