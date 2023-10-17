<template>
    <AuthenticatedLayout title="Home">
        <template #header>
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <h2 class="text-xl font-semibold leading-tight">
                    You are in Home
                </h2>
            </div>
        </template>

        <div
            class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1"
        >
            Welcome Home
        </div>
        <div id="app">
            <ckeditor
                :editor="editor"
                v-model="editorData"
                :config="editorConfig"
            ></ckeditor>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { GithubIcon } from "@/Components/Icons/brands";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "app",
    component: { AuthenticatedLayout, Button, ClassicEditor, GithubIcon },
    data() {
        return {
            editor: ClassicEditor,
            editorData: "<p>Content of the editor.</p>",
            editorConfig: {
                // The configuration of the editor.
            },
        };
    },
};
</script>
