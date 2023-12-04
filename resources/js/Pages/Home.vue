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
    <AuthenticatedLayout title="Home">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Recent Thesis</h2>
            </div>
        </template>
        <div class="p-4 overflow-hidden bg-gray-100 rounded-md shadow-md dark:bg-dark-eval-1">
          <div class="py-1">
            <Button
              variant="success"
              data-modal-target="defaultModal"
              @click="openModal"
              class="block text-white bg-blue-700 hover:bg-blue-800 cursor-pointer"
            >
              References
            </Button>
          </div>
          <ReferenceModal v-if="isModalOpen" />

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
                        
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import ReferenceModal from '@/Components/ReferenceModal.vue';

export default {
  components: {
    ReferenceModal,
  },
  data() {
    return {
      isModalOpen: false,
    };
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
  },
};
</script>
