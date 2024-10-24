<script setup>
import { Head } from "@inertiajs/vue3";
import UpdateInfo from "./Section/UpdateInfo.vue";
import UpdatePassword from "./Section/UpdatePassword.vue";
import DeleteAccount from "./Section/DeleteAccount.vue";

defineProps({
    user: Object,
    status: String,
});
</script>

<template>
    <Head title=" - Profile" />
    <UpdateInfo :status="status" :user="user" />
    <UpdatePassword />
    <DeleteAccount />
</template>

<style scoped></style>
