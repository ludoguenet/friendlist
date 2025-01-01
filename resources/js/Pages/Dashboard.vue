<script setup lang="ts">
import CreatePost from '@/Components/CreateFeed.vue';
import FeedList from '@/Components/FeedList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <CreatePost />

        <FeedList />
    </AuthenticatedLayout>
</template>
