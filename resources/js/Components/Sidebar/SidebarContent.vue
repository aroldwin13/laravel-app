<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { BookmarkIcon } from '@/Components/Icons/outline'
import { ReferencesIcon } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'

</script>

<template>
    <PerfectScrollbar tagname="nav" aria-label="main" class="relative flex flex-col flex-1 max-h-full gap-4 px-3">
        <SidebarCollapsible title="Category: AI" :active="route().current('bookmark')">
            <template #icon>
                <BookmarkIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>
            

            <SidebarCollapsibleItem :href="route('bookmark')" title="Title: Research Index and abstracting System"
                :active="route().current('bookmark')" />
        </SidebarCollapsible>

        <!-- <SidebarCollapsible title="References" :active="route().current('references')">
            <template #icon>
                <ReferencesIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>

            <SidebarCollapsibleItem :href="route('references')" title="Eaton, T. V., & Akers, M. D. (2007). Whistleblowing and good governance. CPA Journal, 77(6), 66–71"
                :active="route().current('references')" />
            <SidebarCollapsibleItem :href="route('references')" title="Alvarez. E., & Tippins, S. (2019). Socialization agents that Puerto Rican college students use to make financial decisions. Journal of Social Change, 11(1), 75–85"
                :active="route().current('references')" />
            <SidebarCollapsibleItem :href="route('references')" title="Laplante, J. P., & Nolin, C. (2014). Consultas and socially responsible investing in Guatemala: A case study examining Maya perspectives on the Indigenous right to free, prior, and informed consent. Society & Natural Resources, 27, 231–248"
                :active="route().current('references')" />
        </SidebarCollapsible> -->



        <!-- <SidebarLink title="Dashboard" :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
                <DashboardIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>
        </SidebarLink> -->

        <!-- <SidebarCollapsible title="Buttons-Templates" :active="route().current('components.*')">
            <template #icon>
                <TemplateIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>

            <SidebarCollapsibleItem :href="route('components.buttons')" title="Buttons"
                :active="route().current('components.buttons')" />
        </SidebarCollapsible> -->

        <!-- Examples -->
        <!--
        => External link example
        <SidebarLink
            title="Github"
            href="https://github.com/kamona-wd/kui-laravel-breeze"
            external
            target="_blank"
        >
        </SidebarLink>

        => Collapsible examples
        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible>-->
    </PerfectScrollbar>
</template>
