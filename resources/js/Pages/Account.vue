<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import SidebarLink from "@/Components/Sidebar/SidebarLink.vue";
import { SubmissionIcon, HomeIcon, AddIcon } from "@/Components/Icons/outline";
import { EditIcon, ViewIcon, DeleteIcon, } from "@/Components/Icons/outline.jsx";

const props = defineProps({
    users: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({});

// function deleteUser(id) {
//     if (confirm("Are you sure you want to Delete")) {
//         form.delete(route("account.deleteUser", id));
//     }
// }
</script>

<template>
    <AuthenticatedLayout title="Account">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Manage Accounts
                </h2>
            </div>
        </template>
        <div class="p-4 overflow-hidden bg-gray-100 rounded-md shadow-md dark:bg-dark-eval-1">
          <div class="flex justify-end">
            <select class="block bg-blue-100 border border-gray-300 rounded-md shadow-md h-10 focus:ring-indigo-500 
            focus:border-indigo-500 dark:bg-dark-eval-2 dark:border-dark-eval-3 dark:focus:ring-dark-eval-1">
                <option value="" default>Filter</option>
                <option value="1">Active</option>
                <option value="0">Not Active</option>
                <option value="1">Admin</option>
                <option value="2">Student</option>
                <option value="3">Coordinator</option>
                <option value="4">Faculty</option>
                <option value="5">Librarian</option>
              </select> &nbsp;
            <Button variant="info" data-modal-target="defaultModal" data-modal-toggle="defaultModal" @click="openModal" class="block text-white bg-blue-700 hover:bg-blue-800 cursor-pointer">
                Create Account
            </Button>
            <RegistrationModal v-if="isModalOpen"  @close-modal="closeModal"/>
          </div>
          <div class="relative overflow-x-auto py-1 shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-mmsu-color dark:bg-gray-700 dark:text-gray-400 shadow-md sm:rounded-lg" 
                       style="border-bottom: 3px solid #ffcd00">
                    <tr class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Username</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in props.users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ index + 1 }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ user.username}}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ user.email}}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ getRoleLabel(user.role) }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                      <div class="flex items-center h-full">
                        <input type="checkbox" v-model="user.status" :id="'toggle-switch-' + user.id" class="hidden" @change="toggleStatus(user)"/>
                        <label
                          :for="'toggle-switch-' + user.id"
                          class="relative w-12 h-6 rounded-full cursor-pointer transition duration-300 ease-in-out bg-gray-300"
                        >
                          <div
                            :class="{'translate-x-6': user.status == 1, 'bg-green-500': user.status == 1, 'bg-red-500': user.status == 0}"
                            class="absolute top-0 left-0 w-6 h-6 rounded-full shadow-md transform transition-transform duration-300"
                          ></div>
                        </label>
                      </div>
                    </td>
                    <td class="px-6 py-4 flex items-center">
                        <Button variant="info" @click="openEditModal(user)">
                            <EditIcon class="flex-shrink-0 w-5 h-5" />
                        </Button>
                        <EditRegistrationModal v-if="isEditModalOpen" :passedData="account"  @close-edit-modal="closeEditModal" />
                        &nbsp;

                        <!-- <Button variant="danger" @click="deleteUser(user.id)">
                            <DeleteIcon class="flex-shrink-0 w-5 h-5" />
                        </Button> -->
                    </td>
                </tr>
                </tbody>
              </table>
          </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import RegistrationModal from '@/Components/RegistrationModal.vue';
import EditRegistrationModal from '@/Components/EditRegistrationModal.vue';
import axios from "axios";

export default {
  // props: {
  //   users: {
  //     type: Array,
  //     default: () => [],
  //   },
  // },
  components: {
    RegistrationModal,
    EditRegistrationModal,
  },
  data() {
    return {
      isModalOpen: false,
      isEditModalOpen: false,
      account: {}
  };
},
  methods: {
    // toggleStatus(user) {
    //   user.isActive = !user.isActive;
    //   this.$emit('status-updated', user.id, user.isActive);
    // },
    toggleStatus(user) {
      const action = user.status === 1 ? 'deactivate' : 'activate';
      if(confirm(`Are you sure to ${user.status === 1 ? 'deactivate' : 'activate'} this account?`)){
        const action = user.status === 1 ? 'deactivate' : 'activate';
        axios.post(`/${action}_user/${user.id}`).then((response) => {
          user.status = user.status === 'deactivate' ? 'active' : 'deactivate';
          alert('Account successfully ${action.charAt(0).toUpperCase() + action.slice(1)}d!');
          this.initialData();
        }).catch((error) => {
          alert('Error while ${action}ing: ${error}');
        });
      }else{
        alert('Canceled');
      }
    },
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    openEditModal(user) {
      this.account = user
      this.isEditModalOpen = true;
    },
    closeEditModal() {
      this.isEditModalOpen = false;
    },
    getRoleLabel(role) {
      switch (role) {
        case 1:
          return 'Admin';
        case 2:
          return 'Student';
        case 3:
          return 'Coordinator';
        case 4:
          return 'Instructor';
        case 5:
          return 'Librarian';
        default:
          return 'Unknown Role';
      }
    },
    // deleteUser(id) {
      // // Display a confirmation dialog
    // const isConfirmed = window.confirm('Are you sure you want to delete this account?');

    // // Check if the user confirmed the action
    // if (isConfirmed) {
    //   axios.post('/delete-account/' + id)
    //     .then((response) => {
    //       window.location.reload();
    //     })
    //     .catch((error) => {
    //       alert('Error: ' + error);
    //     });
    //   }
    // },
  },
};
</script>