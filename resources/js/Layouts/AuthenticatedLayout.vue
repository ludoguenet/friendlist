<template>
    <div>
        <!-- Sidebar gauche -->
        <div
            class="border-r border-gray-200 bg-white lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <div class="flex h-full flex-col px-4 py-6">
                <!-- Profil utilisateur -->
                <div class="flex items-center gap-3">
                    <img
                        class="h-12 w-12 rounded-full"
                        src="https://www.laraveljutsu.net/images/avatar.jpg"
                        alt="User avatar"
                    />
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ $page.props.auth.user.name }}
                        </h2>
                        <p class="text-sm text-gray-500">Web Developer</p>
                    </div>
                </div>

                <!-- Liens supplémentaires -->
                <div class="mt-10">
                    <h3 class="text-sm font-semibold uppercase text-gray-500">
                        Features
                    </h3>
                    <ul role="list" class="mt-4 space-y-3">
                        <!-- Home -->
                        <li>
                            <a
                                :href="route('dashboard')"
                                class="flex items-center gap-x-3 rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6 text-gray-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"
                                    />
                                </svg>

                                Home
                            </a>
                        </li>

                        <!-- Friends -->
                        <li>
                            <a
                                :href="route('friends.index')"
                                class="flex items-center gap-x-3 rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6 text-gray-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                    />
                                </svg>

                                Friends
                            </a>
                        </li>

                        <!-- Requests -->
                        <li>
                            <a
                                :href="route('friends.requestFriends')"
                                class="flex items-center gap-x-3 rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6 text-gray-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3"
                                    />
                                </svg>

                                Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="lg:pl-48">
            <div class="p-4 sm:p-6 lg:p-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script setup></script>
