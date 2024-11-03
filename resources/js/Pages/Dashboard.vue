<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
    listings: Object,
})
</script>

<template>
    <Head title=" Dashboard" />
    <div v-if="listings">
        <div v-if="Object.keys(listings.data).length"></div>

        <div v-else>You Have No Listings</div>
    </div>

    <div v-else>
        Due to violation of the Terms of Service, you are not allowed to list
        please contact us at <span class="text-link">email@admin.com</span>
    </div>
</template>

<style scoped></style>
