<script setup lang="ts">
import { User } from '@/types';
import PeopleSuggestions from './PeopleSuggestions.vue';
import { ref } from 'vue';
import axios from 'axios';

const potentialFriends = ref<Array<User>>([]);

axios.get(route('friends.potentialFriends'))
    .then(({ data }) => {
        potentialFriends.value = data;
    });
</script>

<template>
    <div class="sticky top-20">
        <PeopleSuggestions :potential-friends="potentialFriends" />
    </div>
</template>
