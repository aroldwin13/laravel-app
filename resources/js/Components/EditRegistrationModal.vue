<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import {
    UserIcon,
    MailIcon,
    LockClosedIcon,
    UserAddIcon,
} from "@heroicons/vue/outline";
import InputIconWrapper from "@/Components/InputIconWrapper.vue";
import Input from "@/Components/Input.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import Button from "@/Components/Button.vue";

// const form = useForm({
//     firstname: "",
//     surname: "",
//     role: "",
//     password: "",
//     password_confirmation: "",
//     terms: false,
// });

// const submit = () => {
//     form.post(route("register"), {
//         onFinish: () => form.reset("password", "password_confirmation")
//     });
// };
</script>

<template>
        <div class="fixed inset-0 flex items-center py-20 justify-center z-50 overflow-auto" style="background-color: rgba(0, 0, 0, 0.1  );">
            <!-- Modal content -->
            <div class="bg-blue-100 p-15  max-w-7xl mx-auto rounded-lg shadow-lg z-50">
              <h2 class="text-white text-2xl p-4 bg-mmsu-color rounded-t-lg" style="border-bottom: 3px solid #ffcd00">
                Edit Account
              </h2>
                <ValidationErrors class="mb-4" />
                <form class="p-8" @submit.prevent="save">
                  <div class="grid gap-6">
                      <div class="space-y-2">
                          <InputIconWrapper>
                              <template #icon>
                                  <UserIcon aria-hidden="true" class="w-5 h-5" />
                              </template>
                              <Input
                                  withIcon
                                  id="username"
                                  type="text"
                                  placeholder="Username"
                                  class="block w-full"
                                  v-model="editForm.username"
                                  
                                  required
                                  autofocus
                                  autocomplete="username"
                              />
                          </InputIconWrapper>
                      </div>
                      <div class="space-y-2">
                          <InputIconWrapper>
                              <template #icon>
                                  <UserIcon aria-hidden="true" class="w-5 h-5" />
                              </template>
                              <Input
                                  withIcon
                                  id="email"
                                  type="email"
                                  placeholder="Email"
                                  class="block w-full"
                                  v-model="editForm.email"
                                  required
                                  autofocus
                                  autocomplete="email"
                              />
                          </InputIconWrapper>
                      </div>
                      <div class="space-y-2">
                        <select
                          id="role"
                          v-model="editForm.role"
                          class="block w-full rounded-md border-gray-400 focus:ring focus:ring-green-600"
                          required
                          autofocus
                        >
                          <option value="" disabled>Select role</option>
                          <option value="1">Admin</option>
                          <option value="3">Coordinator</option>
                          <option value="5">Librarian</option>
                        </select>
                      </div>
      
                      <div class="space-y-2">
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
                                  v-model="editForm.password"
                                  required
                                  autocomplete="new-password"
                              />
                          </InputIconWrapper>
                      </div>
      
                      <div class="space-y-2">
                          
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
                                  v-model="editForm.password_confirmation"
                                  required
                                  autocomplete="new-password"
                              />
                          </InputIconWrapper>
                      </div>
      
                      <div class="space-y-2">
                          <Button variant="success"
                              class="justify-center gap-2 w-full" type="submit"
                              v-slot="{ iconSizeClasses }"> 
                              Save
                          </Button>
                          <Button variant="danger" @click="closeEditModal" class=" justify-center gap-2 w-full 
                              text-black-600 hover:text-black-800" aria-label="Close">
                            Cancel
                          </Button>
                      </div>
                  </div>
              </form>
          </div>
        </div>
</template>

<script>
import axios from "axios";

export default {
  props: [
    'passedData'
  ],
  data() {
    return {
      isEditModalOpen: false, // Initialize it as false to start with the modal closed.
      editForm: {
        username: this.passedData.username,
        email: this.passedData.email,
        role: this.passedData.role,
        password: "",
        password_confirmation: "",
        terms: false,
      },
      passed_username: this.passedData.username,
      passed_email: this.passedData.email,
      passed_role: this.passedData.role
    };
  },
  mounted() {
    this.putData();
  },
  methods: {
    openEditModal() {
      this.isEditModalOpen = true;
    },
    closeEditModal() {
      this.isEditModalOpen = false;
      this.$emit('close-edit-modal');
    },
    save() {
      axios.post('/edit-account/'+this.passedData.id, this.editForm)
        .then(response => {
          // Handle success, reset form fields if needed
          this.editForm.username = ''
          this.editForm.email = ''
          this.editForm.role = ''
          this.editForm.password = ''
          this.editForm.password_confirmation = ''
          this.terms = false

          this.isModalOpen = false;
          window.location.reload();
          this.$emit('close-modal');
        })
        .catch(error => {
          // Handle error
          console.error('Error submitting form:', error);
        });
      },
  },
};
</script>
