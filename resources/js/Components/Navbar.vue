<script setup>
import { SubmissionIcon, HomeIcon, AssessmentIcon, GenerateIcon, AccountIcon} from '@/Components/Icons/outline';
import { computed } from 'vue';


import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { useFullscreen } from '@vueuse/core'
import {
    SunIcon,
    MoonIcon,
    SearchIcon,
    MenuIcon,
    XIcon,
    ArrowsExpandIcon,
} from '@heroicons/vue/outline'
import {
    handleScroll,
    isDark,
    scrolling,
    toggleDarkMode,
    sidebarState,
} from '@/Composables'
import Button from '@/Components/Button.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import { ArrowsInnerIcon } from '@/Components/Icons/outline'
import { ref } from 'vue';


const showSearchInput = ref(false);

const toggleSearchInput = () => {
  showSearchInput.value = !showSearchInput.value;
};
const { isFullscreen, toggle: toggleFullScreen } = useFullscreen()

onMounted(() => {
    document.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    document.removeEventListener('scroll', handleScroll)
})

// const showOption = computed(() => document.cookie.includes('isAdmin=0'));

async function logout() {
    document.cookie = 'your_cookie_name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
}
</script>

<template>
    <nav aria-label="secondary" style="border-bottom: 3px solid #ffcd00 ;" :class="[
        'sticky top-0 z-10 py-4 bg-mmsu-color flex items-center justify-between transition-transform duration-500 dark:bg-dark-eval-1',
        {
            '-translate-y-full': scrolling.down,
            'translate-y-0': scrolling.up,
        },
    ]">
    <div class="flex items-center gap-20">
        <Link class="inline-flex items-center gap-2 pl-3">
            <span class="sr-only">K-UI</span>
            <ApplicationLogo aria-hidden="true" class="w-10 h-auto" />
            <span class="sidebar-text text-white">MMSU Archive System</span>

        </Link>
    
        <div class="flex items-center gap-2">  
            <div>
            <SidebarLink title="Home" :href="route('home')" :active="route().current('home')">
                <template #icon>
                    <HomeIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </template>
            </SidebarLink>
            </div>
            <div v-if="$page.props.auth.user.role == 'admin' || $page.props.auth.user.role == 'student'">
                <SidebarLink title="Submission" :href="route('submission')" :active="route().current('submission')">
                    <template #icon>
                        <SubmissionIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                    </template>
                </SidebarLink>
            </div>
            <div v-if="$page.props.auth.user.role == 'admin' || $page.props.auth.user.role == 'coordinator'">
                <SidebarLink title="Assessment" :href="route('assessment')" :active="route().current('assessment')">
                    <template #icon>
                        <AssessmentIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                    </template>
                </SidebarLink>
            </div>
            <div v-if="$page.props.auth.user.role == 'admin' || $page.props.auth.user.role == 'librarian'">
                <SidebarLink title="Generate Report" :href="route('generate')" :active="route().current('generate')">
                    <template #icon>
                        <GenerateIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                    </template>
                </SidebarLink>
            </div>
            <div v-if="$page.props.auth.user.role == 'admin' ">
                <SidebarLink title="Account" :href="route('account')" :active="route().current('account')">
                    <template #icon>
                        <AccountIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                    </template>
                </SidebarLink>
            </div>
        </div>
    </div>
        <div class="flex items-center gap-2">
            <Button iconOnly variant="secondary" type="button" @click="toggleDarkMode" v-slot="{ iconSizeClasses }"
                class="md:hidden" srText="Toggle dark mode">
                <MoonIcon v-show="!isDark" aria-hidden="true" :class="iconSizeClasses" />
                <SunIcon v-show="isDark" aria-hidden="true" :class="iconSizeClasses" />
            </Button>
        </div>
        <div class="flex items-center gap-2">
            <div class="flex items-center gap-2">
                <!-- Search input -->
                <input
                  v-if="showSearchInput"
                  type="text"
                  placeholder="Search..."
                  class="border border-gray-300 rounded px-2 py-1"
                />
            
                <!-- Button to toggle search input -->
                <Button
                  iconOnly
                  variant="secondary"
                  type="button"
                  v-slot="{ iconSizeClasses }"
                  @click="toggleSearchInput"
                  srText="Search"
                >
                  <SearchIcon aria-hidden="true" :class="iconSizeClasses" />
                </Button>
              </div>
          
            <Button iconOnly variant="secondary" type="button" @click="toggleDarkMode" v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex" srText="Toggle dark mode">
                <MoonIcon v-show="!isDark" aria-hidden="true" :class="iconSizeClasses" />
                <SunIcon v-show="isDark" aria-hidden="true" :class="iconSizeClasses" />
            </Button>

            <Button iconOnly variant="secondary" type="button" @click="toggleFullScreen" v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex" srText="Toggle dark mode">
                <ArrowsExpandIcon v-show="!isFullscreen" aria-hidden="true" :class="iconSizeClasses" />
                <ArrowsInnerIcon v-show="isFullscreen" aria-hidden="true" :class="iconSizeClasses" />
            </Button>

            <!-- Dropdwon -->
            <Dropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out bg-mmsu-color border border-transparent rounded-md hover:text-gray   -500 focus:outline-none focus:ring-mmsu-color  focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:bg-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                            {{ $page.props.auth.user.firstname }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <DropdownLink :href="route('profile.edit')">
                        Profile
                    </DropdownLink>

                    <DropdownLink @click="logout" :href="route('logout')" method="post" as="button">
                        Log Out
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </nav>

    <!-- Mobile bottom bar -->
    <div :class="[
        'fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1',
        {
            'translate-y-full': scrolling.down,
            'translate-y-0': scrolling.up,
        },
    ]">
       

        <Link :href="route('dashboard')">
        <ApplicationLogo class="w-10 h-10" />
        <span class="sr-only">K UI</span>
        </Link>

        <Button iconOnly variant="secondary" type="button" @click="sidebarState.isOpen = !sidebarState.isOpen"
            v-slot="{ iconSizeClasses }" class="md:hidden" srText="Search">
            <MenuIcon v-show="!sidebarState.isOpen" aria-hidden="true" :class="iconSizeClasses" />
            <XIcon v-show="sidebarState.isOpen" aria-hidden="true" :class="iconSizeClasses" />
        </Button>
    </div>
</template>
