<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import { GithubIcon } from '@/Components/Icons/brands'

import PrimaryButton from "@/Components/Button.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";


const props = defineProps({
    blogs: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("blogs.destroy", id));
    }
}

const variantClasses = (variant) => ({
  'bg-mmsu-color text-white hover:bg-mmsu-color focus:ring-mmsu-color': variant === 'primary',
  'bg-white text-gray-500 hover:bg-gray-100 focus:ring-green-500 dark:text-gray-400 dark:bg-dark-eval-1 dark:hover:bg-dark-eval-2 dark:hover:text-gray-200':
    variant === 'secondary',
  'bg-green-500 text-white hover:bg-green-600 focus:ring-green-500': variant === 'success',
  'bg-red-500 text-white hover:bg-red-600 focus:ring-red-500': variant === 'danger',
  'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500': variant === 'warning',
  'bg-cyan-500 text-white hover:bg-cyan-600 focus:ring-cyan-500': variant === 'info',
  'bg-black text-gray-300 hover:text-white hover:bg-gray-800 focus:ring-black dark:hover:bg-dark-eval-3':
    variant === 'black',
});
</script>



<template>
  <AuthenticatedLayout title="Submission">
    <template #header>
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-semibold leading-tight">
          Thesis Submission
        </h2>
      </div>
    </template>

    <div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
      <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
              <Link :href="route('blogs.create')">
                <PrimaryButton>Add Thesis</PrimaryButton>
              </Link>
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
                  <tr v-for="blog in blogs" :key="blog.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ blog.id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ blog.title }}</td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4 flex items-center">
                        <Button variant="success" @click="destroy(blog.id)">View</Button>
                        <Link :href="route('blogs.edit', blog.id)" class="px-4 py-2 text-white bg-blue-600 rounded-lg w-20 text-center">Edit</Link>
                        <Button variant="danger" @click="destroy(blog.id)">Delete</Button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

