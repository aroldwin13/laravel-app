<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";

import Button from "@/Components/Button.vue";

import Input from "@/Components/Input.vue";
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
        console.error("Error submitting form:", error);
        // Handle errors that may occur during submission
    }
};
</script>

<template>
    <AuthenticatedLayout title="Account">
        <template #header>
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <h2 class="text-xl font-semibold leading-tight">
                    You are in Account
                </h2>
            </div>
        </template>
        <div
            class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1"
        >
            Welcome Accounts
            <ol
                class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0"
            >
                <li
                    ref="phase1Head"
                    :class="{
                        'text-blue-600 dark:text-blue-500': isPhase1Head
                            ? 'text-gray-500 dark:text-gray-400'
                            : isPhase1Head,
                    }"
                    class="flex items-center space-x-2.5"
                >
                    <span
                        :class="{
                            'border-blue-600 dark:border-blue-500': isPhase1Head
                                ? 'border-gray-500 dark:border-gray-400'
                                : isPhase1Head,
                        }"
                        class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0"
                    >
                        1
                    </span>
                    <span>
                        <h3 class="font-medium leading-tight">Thesis Type</h3>
                        <p class="text-sm">Step types here</p>
                    </span>
                </li>
                <li
                    ref="phase2Head"
                    :class="{
                        'text-blue-600 dark:text-blue-500': isPhase2Head
                            ? 'text-gray-500 dark:text-gray-400'
                            : isPhase2Head,
                    }"
                    class="flex items-center space-x-2.5"
                >
                    <span
                        :class="{
                            'border-blue-600 dark:border-blue-500': isPhase2Head
                                ? 'border-gray-500 dark:border-gray-400'
                                : isPhase2Head,
                        }"
                        class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0"
                    >
                        2
                    </span>
                    <span>
                        <h3 class="font-medium leading-tight">Details</h3>
                        <p class="text-sm">Step details here</p>
                    </span>
                </li>
                <li
                    ref="phase3Head"
                    :class="{
                        'text-blue-600 dark:text-blue-500': isPhase3Head
                            ? 'text-gray-500 dark:text-gray-400'
                            : isPhase3Head,
                    }"
                    class="flex items-center space-x-2.5"
                >
                    <span
                        :class="{
                            'border-blue-600 dark:border-blue-500': isPhase3Head
                                ? 'border-gray-500 dark:border-gray-400'
                                : isPhase3Head,
                        }"
                        class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0"
                    >
                        3
                    </span>
                    <span>
                        <h3 class="font-medium leading-tight">Contributor</h3>
                        <p class="text-sm">Step contributors here</p>
                    </span>
                </li>

                <li
                    ref="phase4Head"
                    :class="{
                        'text-blue-600 dark:text-blue-500': isPhase4Head
                            ? 'text-gray-500 dark:text-gray-400'
                            : isPhase4Head,
                    }"
                    class="flex items-center space-x-2.5"
                >
                    <span
                        :class="{
                            'border-blue-600 dark:border-blue-500': isPhase4Head
                                ? 'border-gray-500 dark:border-gray-400'
                                : isPhase4Head,
                        }"
                        class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0"
                    >
                        4
                    </span>
                    <span>
                        <h3 class="font-medium leading-tight">
                            References and Citations
                        </h3>
                        <p class="text-sm">Step references and citation here</p>
                    </span>
                </li>
            </ol>

            <div class="py-5">
                <div v-show="step1 == true">
                    <select id="documentType">
                        <option value="publisher">Publisher</option>
                        <option value="book">Book</option>
                        <option value="thesis">Thesis</option>
                    </select>
                    <div>
                        <Button
                            variant="success"
                            @click="
                                step1 = !step1;
                                step2 = true;
                                isPhase1Head = false;
                                isPhase2Head = true;
                            "
                        >
                            Next
                        </Button>
                    </div>
                </div>

                <div v-show="step2 == true">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Title formv and Adviser -->
                            <div class="mt-4">
                                <label
                                    for="title"
                                    class="block text-sm font-medium text-gray-700"
                                    >Title</label
                                >
                                <input
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                    v-model="form.title"
                                />
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.title"
                                >
                                    {{ form.errors.title }}
                                </p>
                            </div>
                            <div class="mt-4">
                                <label
                                    for="series"
                                    class="block text-sm font-medium text-gray-700"
                                    >Series</label
                                >
                                <input
                                    id="series"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                    v-model="form.series"
                                />
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.series"
                                >
                                    {{ form.errors.series }}
                                </p>
                            </div>

                            <!-- Series_Num and Volume -->

                            <div class="mt-4">
                                <label
                                    for="series_num"
                                    class="block text-sm font-medium text-gray-700"
                                    >Series Number</label
                                >
                                <input
                                    id="series_num"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                    v-model="form.series_num"
                                />
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.series_num"
                                >
                                    {{ form.errors.series_num }}
                                </p>
                            </div>

                            <div class="mt-4">
                                <label
                                    for="volume"
                                    class="block text-sm font-medium text-gray-700"
                                    >Volume</label
                                >
                                <input
                                    id="volume"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                    v-model="form.volume"
                                />
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.volume"
                                >
                                    {{ form.errors.volume }}
                                </p>
                            </div>

                            <!-- Num_Volume and Edition -->
                            <div class="mt-4">
                                <label
                                    for="num_volume"
                                    class="block text-sm font-medium text-gray-700"
                                    >Number Volume</label
                                >
                                <input
                                    id="num_volume"
                                    type="text"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                    v-model="form.num_volume"
                                />
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.num_volume"
                                >
                                    {{ form.errors.num_volume }}
                                </p>
                            </div>

                            <div class="mt-3">
                                <label
                                    for="edition"
                                    class="block text-sm font-medium text-gray-700"
                                    >Edition</label
                                >
                                <Input
                                    id="edition"
                                    v-model="form.edition"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                ></Input>
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.edition"
                                >
                                    {{ form.errors.edition }}
                                </p>
                            </div>

                            <!-- Place and Keywords Publisher -->

                            <div class="mt-4">
                                <label
                                    for="place"
                                    class="block text-sm font-medium text-gray-700"
                                    >Place</label
                                >
                                <Input
                                    id="place"
                                    v-model="form.place"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                ></Input>
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.place"
                                >
                                    {{ form.errors.place }}
                                </p>
                            </div>

                            <div class="mt-4">
                                <label
                                    for="publisher"
                                    class="block text-sm font-medium text-gray-700"
                                    >Publisher</label
                                >
                                <Input
                                    id="publisher"
                                    v-model="form.publisher"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                ></Input>
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.publisher"
                                >
                                    {{ form.errors.publisher }}
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
                    </div>
                    <div>
                        <Button
                            variant="info"
                            @click="
                                step1 = true;
                                step2 = false;
                                isPhase1Head = true;
                                isPhase2Head = false;
                            "
                        >
                            Previous
                        </Button>
                    </div>
                    <div>
                        <Button
                            :disabled="
                                !form.title ||
                                !form.series ||
                                !form.series_num ||
                                !form.volume ||
                                !form.num_volume ||
                                !form.edition ||
                                !form.place ||
                                !form.publisher ||
                                !form.shortabs
                            "
                            variant="success"
                            @click="
                                step2 = false;
                                step3 = true;
                                isPhase3Head = true;
                                isPhase2Head = false;
                            "
                        >
                            Next
                        </Button>
                    </div>
                </div>

                <!-- Contributors -->

                <div v-show="step3 == true">
                    <div class="grid grid-cols-2 gap-2">
                        <!-- Authors formv and Adviser -->
                        <div class="mt-4">
                            <label
                                for="authors"
                                class="block text-sm font-medium text-gray-700"
                                >Authors</label
                            >
                            <input
                                id="authors"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.authors"
                            />
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.authors"
                            >
                                {{ form.errors.authors }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <label
                                for="adviser"
                                class="block text-sm font-medium text-gray-700"
                                >Adviser</label
                            >
                            <input
                                id="adviser"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.adviser"
                            />
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.adviser"
                            >
                                {{ form.errors.adviser }}
                            </p>
                        </div>
                        <!-- Panels -->
                        <div class="mt-4">
                            <label
                                for="panels"
                                class="block text-sm font-medium text-gray-700"
                                >Panels</label
                            >
                            <input
                                id="panels"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                v-model="form.panels"
                            />
                            <p
                                class="mt-1 text-sm text-red-600"
                                v-if="form.errors.panels"
                            >
                                {{ form.errors.panels }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <Button
                            variant="info"
                            @click="
                                step2 = true;
                                step3 = false;
                                isPhase2Head = true;
                                isPhase3Head = false;
                                disabled = !disabled;
                            "
                        >
                            Previous
                        </Button>
                    </div>
                    <div>
                        <Button
                            :disabled="
                                !form.authors || !form.adviser || !form.panels
                            "
                            variant="success"
                            @click="
                                step3 = false;
                                step4 = true;
                                isPhase3Head = false;
                                isPhase4Head = true;
                            "
                        >
                            Next
                        </Button>
                    </div>
                </div>

                <div v-show="step4 == true">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-2 gap-2">
                            <!--References and Citations -->

                            <div class="mt-4">
                                <label
                                    for="references"
                                    class="block text-sm font-medium text-gray-700"
                                    >References</label
                                >
                                <textarea
                                    id="references"
                                    v-model="form.references"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-mmsu-color focus:border-mmsu-color sm:text-sm"
                                ></textarea>
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    v-if="form.errors.references"
                                >
                                    {{ form.errors.references }}
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
                        </div>
                    </div>
                    <div>
                        <Button
                            variant="info"
                            @click="
                                step3 = true;
                                step4 = false;
                                isPhase3Head = true;
                                isPhase4Head = false;
                            "
                        >
                            Previous
                        </Button>
                    </div>

                    <!-- Submit form button -->
                    <Button :disabled="!form.authors || !form.adviser">
                        Submit
                    </Button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "app",
    component: { ClassicEditor },
    data() {
        return {
            editor: ClassicEditor,
            editorData: "<p>Content of the editor.</p>",
            editorConfig: {
                // The configuration of the editor.
            },
            step1: true,
            step2: false,
            step3: false,
            step4: false,
            isPhase1Head: true,
            isPhase2Head: false,
            isPhase3Head: false,
            isPhase4Head: false,
        };
    },
    methods: {
        getValues() {},
    },
};
</script>
