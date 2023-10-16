<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import TextInput from "@/Components/Input.vue";
import PrimaryButton from "@/Components/Button.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";

import { Head, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    submissions: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    title: "",
    shortabs: "",
});

const submit = async () => {
    try {
        await form.post(route("submissions.store"));
        // Optionally, you can redirect or perform any actions upon successful submission
        // For example, redirect to a new page:
        // this.$inertia.visit(route('blogs.index'));
    } catch (error) {
        console.error('Error submitting form:', error);
        // Handle errors that may occur during submission
    }
};
</script>

<template>
    <AuthenticatedLayout title="Bookmark">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Thesis Submission Form
                </h2>

                <!-- <Button
                    external
                    variant="black"
                    target="_blank"
                    class="items-center max-w-xs gap-2"
                    v-slot="{ iconSizeClasses }"
                    href="https://github.com/kamona-wd/kui-laravel-breeze"
                >
                    <GithubIcon aria-hidden="true" :class="iconSizeClasses" />

                    <span>Star on Github</span>
                </Button> -->
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                   <div class="p-6 bg-white border-b border-gray-200">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-2">
                        <!-- Title formv and Adviser -->
                        <div class="mt-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm" v-model="form.title">
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.title">{{ form.errors.title }}</p>
                        </div>
                        <div class="mt-4">
                            <label for="adviser" class="block text-sm font-medium text-gray-700">Adviser</label>
                            <input id="adviser" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"  v-model="form.adviser">
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.adviser">{{ form.errors.adviser }}</p>
                        </div>
                        
                    
                        <!-- Author and College form -->

                        <div class="mt-4">
                            <label for="authors" class="block text-sm font-medium text-gray-700">Authors</label>
                            <input id="authors" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm" v-model="form.author" >
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.authors">{{ form.errors.authors }}</p>
                        </div>
                
                        <div class="mt-4">
                            <label for="college" class="block text-sm font-medium text-gray-700">College</label>
                            <input id="college" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm" v-model="form.college">
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.college">{{ form.errors.college }}</p>
                        </div>
                    
                    
                        <!-- Citation and Department form -->
                        <div class="mt-4">
                            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                            <input id="department" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm" v-model="form.department">
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.department">{{ form.errors.department }}</p>
                        </div>
                        
                        <div class="mt-3">
                            <label for="citation" class="block text-sm font-medium text-gray-700">Citation</label>
                            <textarea id="citation" v-model="form.citation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"></textarea>
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.citation">{{ form.errors.citation }}</p>
                        </div>

                    
                        <!-- References and Keywords form -->
                        <div class="mt-4">
                            <label for="references" class="block text-sm font-medium text-gray-700">References</label>
                            <textarea id="references" v-model="form.references" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"></textarea>
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.references">{{ form.errors.references }}</p>
                        </div>
                
                        <div class="mt-4">
                            <label for="keywords" class="block text-sm font-medium text-gray-700">Keywords</label>
                            <textarea id="keywords" v-model="form.keywords" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"></textarea>
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.keywords">{{ form.errors.keywords }}</p>
                        </div>

                    
                    
                    </div> 
                        <!-- Short Abstract form -->
                        <div class="mt-4">
                            <label for="shortabs" class="block text-sm font-medium text-gray-700">Short Abstract</label>
                            <ckeditor :editor="editor" v-model="form.shortabs" :config="editorConfig" id="shortabs" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"></ckeditor>
                            <!-- <textarea id="shortabs" v-model="form.shortabs" class="w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus-border-blue-500 text-gray-900 text-sm" style="width: 645px; height: 300px;"></textarea> -->
                            <p class="mt-1 text-sm text-red-600" v-if="form.errors.shortabs">{{ form.errors.shortabs }}</p>
                        </div> 
                    <br>
                        <!-- Submit form button -->
                        <PrimaryButton type="submit" style="color: white;" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Submit
                        </PrimaryButton>
                </form>
            </div> 
        </div>
    </AuthenticatedLayout>
</template>


<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: 'app',
    component: { ClassicEditor },
    data() {
        return {
            editor: ClassicEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                // The configuration of the editor.
            }
        };
    }
}
</script>
