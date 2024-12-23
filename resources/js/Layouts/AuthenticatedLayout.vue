<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                class="relative z-50 lg:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel
                            class="relative mr-16 flex w-full max-w-xs flex-1"
                        >
                            <TransitionChild
                                as="template"
                                enter="ease-in-out duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="ease-in-out duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="absolute left-full top-0 flex w-16 justify-center pt-5"
                                >
                                    <button
                                        type="button"
                                        class="-m-2.5 p-2.5"
                                        @click="sidebarOpen = false"
                                    >
                                        <span class="sr-only"
                                            >Close sidebar</span
                                        >
                                        <XMarkIcon
                                            class="size-6 text-white"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </TransitionChild>
                            <div
                                class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-2"
                            >
                                <div class="flex h-16 shrink-0 items-center">
                                    <ApplicationLogo class="h-10 w-auto" />
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul
                                        role="list"
                                        class="flex flex-1 flex-col gap-y-7"
                                    >
                                        <li>
                                            <ul
                                                role="list"
                                                class="-mx-2 space-y-1"
                                            >
                                                <li
                                                    v-for="item in navigation"
                                                    :key="item.name"
                                                >
                                                    <a
                                                        :href="item.href"
                                                        :class="[
                                                            item.current
                                                                ? 'bg-gray-50 text-sky-600'
                                                                : 'text-gray-700 hover:bg-gray-50 hover:text-sky-600',
                                                            'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                                        ]"
                                                    >
                                                        <component
                                                            :is="item.icon"
                                                            :class="[
                                                                item.current
                                                                    ? 'text-sky-600'
                                                                    : 'text-gray-400 group-hover:text-sky-600',
                                                                'size-6 shrink-0',
                                                            ]"
                                                            aria-hidden="true"
                                                        />
                                                        {{ item.name }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div
                                                class="text-xs/6 font-semibold text-gray-400"
                                            >
                                                Liens importants
                                            </div>
                                            <ul
                                                role="list"
                                                class="-mx-2 mt-2 space-y-1"
                                            >
                                                <li
                                                    v-for="link in links"
                                                    :key="link.name"
                                                >
                                                    <a
                                                        :href="link.href"
                                                        :class="[
                                                            link.current
                                                                ? 'bg-gray-50 text-sky-600'
                                                                : 'text-gray-700 hover:bg-gray-50 hover:text-sky-600',
                                                            'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                                        ]"
                                                    >
                                                        <span
                                                            :class="[
                                                                link.current
                                                                    ? 'border-sky-600 text-sky-600'
                                                                    : 'border-gray-200 text-gray-400 group-hover:border-sky-600 group-hover:text-sky-600',
                                                                'flex size-6 shrink-0 items-center justify-center rounded-lg border bg-white text-[0.625rem] font-medium',
                                                            ]"
                                                            >{{
                                                                link.initial
                                                            }}</span
                                                        >
                                                        <span
                                                            class="truncate"
                                                            >{{
                                                                link.name
                                                            }}</span
                                                        >
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <div
            class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <div
                class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6"
            >
                <div class="flex h-16 shrink-0 items-center">
                    <ApplicationLogo class="h-10 w-auto fill-sky-500" />
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <a
                                        :href="item.href"
                                        :class="[
                                            item.current
                                                ? 'bg-gray-50 text-sky-600'
                                                : 'text-gray-700 hover:bg-gray-50 hover:text-sky-600',
                                            'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                        ]"
                                    >
                                        <component
                                            :is="item.icon"
                                            :class="[
                                                item.current
                                                    ? 'text-sky-600'
                                                    : 'text-gray-400 group-hover:text-sky-600',
                                                'size-6 shrink-0',
                                            ]"
                                            aria-hidden="true"
                                        />
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="text-xs/6 font-semibold text-gray-400">
                                Mes liens
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li v-for="link in links" :key="link.name">
                                    <a
                                        :href="link.href"
                                        :class="[
                                            link.current
                                                ? 'bg-gray-50 text-sky-600'
                                                : 'text-gray-700 hover:bg-gray-50 hover:text-sky-600',
                                            'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                        ]"
                                    >
                                        <span
                                            :class="[
                                                link.current
                                                    ? 'border-sky-600 text-sky-600'
                                                    : 'border-gray-200 text-gray-400 group-hover:border-sky-600 group-hover:text-sky-600',
                                                'flex size-6 shrink-0 items-center justify-center rounded-lg border bg-white text-[0.625rem] font-medium',
                                            ]"
                                            >{{ link.initial }}</span
                                        >
                                        <span class="truncate">{{
                                            link.name
                                        }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="-mx-6 mt-auto">
                            <a
                                href="#"
                                class="flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-50"
                            >
                                <img
                                    class="size-8 rounded-full bg-gray-50"
                                    src="https://www.laraveljutsu.net/images/avatar.jpg"
                                    alt=""
                                />
                                <span class="sr-only">Your profile</span>
                                <span aria-hidden="true">
                                    {{ $page.props.auth.user.name }}</span
                                >
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div
            class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden"
        >
            <button
                type="button"
                class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                @click="sidebarOpen = true"
            >
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="size-6" aria-hidden="true" />
            </button>
            <div class="flex-1 text-sm/6 font-semibold text-gray-900">
                Dashboard
            </div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img
                    class="size-8 rounded-full bg-gray-50"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt=""
                />
            </a>
        </div>

        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import {
    Bars3Icon,
    HomeIcon,
    IdentificationIcon,
    UserGroupIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline';
import { ref } from 'vue';

const navigation = [
    {
        name: 'Dashboard',
        href: route('dashboard'),
        icon: HomeIcon,
        current: route().current('dashboard'),
    },
    {
        name: 'Mes ami.es',
        href: route('friends.index'),
        icon: UserGroupIcon,
        current: route().current('friends.index'),
    },
    {
        name: 'Mes demandes',
        href: route('friends.create'),
        icon: IdentificationIcon,
        current: route().current('friends.create'),
    },
];

const links = [
    {
        id: 1,
        name: 'LaravelJutsu',
        href: 'https://laraveljutsu.net',
        initial: 'LJ',
        current: false,
    },
    {
        id: 2,
        name: 'InertiaJS 2.0',
        href: 'https://inertiajs.com/upgrade-guide',
        initial: 'I',
        current: false,
    },
    {
        id: 3,
        name: 'Laravel',
        href: 'https://laravel.com',
        initial: 'L',
        current: false,
    },
];

const sidebarOpen = ref(false);
</script>
