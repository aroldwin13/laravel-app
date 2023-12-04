<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import {
    UserIcon,
    MailIcon,
    LockClosedIcon,
    UserAddIcon,
} from "@heroicons/vue/outline";
import GuestLayout from "@/Layouts/Guest.vue";
import InputIconWrapper from "@/Components/InputIconWrapper.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import PrimaryButton from "@/Components/Button.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import axios from "axios";

</script>
<template>
    <AuthenticatedLayout title="References">
        <div class="flex items-center justify-center z-50"
             style="background-color: rgba(0, 0, 0, 0.5);">
            <div v-if="isModalOpen" class="fixed inset-0 bg-white p-8 max-w-xl mx-auto rounded shadow-lg z-50 overflow-auto">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="form-group ">
                            <label for="item_type" class="block text-sm font-medium text-gray-700">Item Type:</label>
                            <select id="item_type" name="item_type" class="form-control block w-full border-gray-300 rounded-md shadow-sm 
                                    focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm">
                                <option value="">Select Type</option>
                                <option value="1">E-Book</option>
                                <option value="2">Book</option>
                                <option value="3">Thesis</option>
                                <option value="4">Capstone</option>
                                <option value="5">Publication</option>
                            </select>
                        </div>
                        <!-- Title formv and Adviser -->
                        <div class="mt-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.title" />
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.title">
                                {{ form.errors.title }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <label for="adviser" class="block text-sm font-medium text-gray-700">Adviser</label>
                            <input id="adviser" type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.adviser"/>
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.adviser">
                                {{ form.errors.adviser }}
                            </p>
                        </div>

                        <!-- Author and College form -->

                        <div class="form-group">
                            <label for="authors" class="block text-sm font-medium text-gray-700">Author</label>
                            <div id="authorContainer">
                                <div class="author-row" v-for="(author, index) in authors" :key="index">
                                    <div class="col-md-2 relative overflow-x-auto">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <tr>
                                                <th>
                                                    <input type="text" :name="'fname[' + index + ']'" class="form-control mt-1 block w-full 
                                                            border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color 
                                                            sm:text-sm" placeholder="First Name">
                                                </th>
                                                <th>
                                                    <input type="text" :name="'lname[' + index + ']'" class="form-control mt-1 block w-full 
                                                            border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color 
                                                            sm:text-sm" placeholder="Last Name">

                                                </th>
                                                <th>
                                                    <div class="flex justify-end col-md-2 pt-2">
                                                        <Button variant="danger" type="button" class="remove-author" @click="removeAuthor(index)">-</Button>
                                                        &nbsp;
                                                        <Button variant="success" type="button" class="add-author" @click="addAuthor">+</Button>
                                                    </div>
                                                </th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label
                                for="college"
                                class="block text-sm font-medium text-gray-700"
                                >College</label
                            >
                            <input
                                id="college"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.college"
                            />
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.college"
                            >
                                {{ form.errors.college }}
                            </p>
                        </div>

                        <!-- Citation and Department form -->
                        <div class="mt-4">
                            <label
                                for="department"
                                class="block text-sm font-medium text-gray-700"
                                >Department</label
                            >
                            <input
                                id="department"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.department"
                            />
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.department"
                            >
                                {{ form.errors.department }}
                            </p>
                        </div>

                        <div class="mt-3">
                            <label
                                for="citation"
                                class="block text-sm font-medium text-gray-700"
                                >Citation</label
                            >
                            <textarea
                                id="citation"
                                v-model="form.citation"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                            ></textarea>
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.citation"
                            >
                                {{ form.errors.citation }}
                            </p>
                        </div>

                        <!-- References and Keywords form -->
                        

                        <div class="mt-4">
                            <label
                                for="keywords"
                                class="block text-sm font-medium text-gray-700"
                                >Keywords</label
                            >
                            <textarea
                                id="keywords"
                                v-model="form.keywords"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                            ></textarea>
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.keywords"
                            >
                                {{ form.errors.keywords }}
                            </p>
                        </div>
                    </div>
                    <!-- Short Abstract form -->
                    <div class="mt-4">
                        <label
                            for="shortabs"
                            class="block text-sm font-medium text-gray-700"
                            >Short Abstract</label
                        >
                        <ckeditor
                            :editor="editor"
                            v-model="form.shortabs"
                            :config="editorConfig"
                            id="shortabs"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                        ></ckeditor>
                        <!-- <textarea id="shortabs" v-model="form.shortabs" class="w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus-border-blue-500 text-gray-900 text-sm" style="width: 645px; height: 300px;"></textarea> -->
                        <p
                            class="mt-1 text-sm text-red-600"
                            v-if="form.errors.shortabs"
                        >
                            {{ form.errors.shortabs }}
                        </p>
                    </div>
                    <br />
                    <!-- Submit form button -->
                    <PrimaryButton
                        type="submit"
                        style="color: white"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Submit
                    </PrimaryButton>
                </form>
            </div>
            <div class="flex justify-end">
                <Button variant="danger" type="button" class="btn btn-default block text-sm font-medium text-gray-700" @click="closeModal">Cancel</Button>
                &nbsp;
                <Button variant="success" type="button" class="btn btn-primary block text-sm font-medium text-gray-700">Add</Button>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 
<script>

export default {
  data() {
    return {
      isModalOpen: true,
      authors: [{ fname: '', lname: '' }],
    };
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      this.$emit('close-modal');
    },
    addAuthor() {
      this.authors.push({ fname: '', lname: '' });
    },
    removeAuthor(index) {
        if (this.authors.length > 1) {
            this.authors.splice(index, 1);
        }
    },
  },
};
</script>