<script setup>
import {Head} from "@inertiajs/vue3";
import UpdateInfo from "./Section/UpdateInfo.vue";
import UpdatePassword from "./Section/UpdatePassword.vue";

defineProps({
  user: Object,
  status: String,
})
</script>

<template>

  <Head title=" - Profile"/>
  <UpdateInfo :status="status" :user="user"/>
  <UpdatePassword/>

</template>

<style scoped>

</style>