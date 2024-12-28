<script setup lang="ts">
import NavBar from '@/Components/NavBar.vue';
import ProfileCard from '@/Components/ProfileCard.vue';
import RightSidebar from '@/Components/RightSidebar/RightSidebar.vue';
import SidebarLinks from '@/Components/SidebarLinks.vue';
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <NavBar />

        <main class="pb-8 pt-20">
            <div class="mx-auto grid max-w-7xl grid-cols-12 gap-6 px-4">
                <!-- Left Sidebar -->
                <div class="col-span-3">
                    <div class="sticky top-20">
                        <ProfileCard
                            :name="$page.props.auth.user.name"
                            role="Software Engineer"
                            avatar="/avatar.png"
                        />
                        <SidebarLinks />
                    </div>
                </div>

                <!-- Main Feed -->
                <div class="col-span-6">
                    <slot />
                    <!-- Feed posts would go here -->
                </div>

                <!-- Right Sidebar -->
                <div class="col-span-3">
                    <RightSidebar />
                </div>
            </div>
        </main>
    </div>
</template>
