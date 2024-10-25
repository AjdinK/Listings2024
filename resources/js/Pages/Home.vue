<script setup>
import {Head, router, useForm} from "@inertiajs/vue3";
import Card from "../Componetns/Card.vue";
import PaginationLinks from "../Componetns/PaginationLinks.vue";
import InputField from "../Componetns/InputField.vue";

const props = defineProps({
  listings: Object,
  searchTerm: String,
});

const form = useForm({
  search: props.searchTerm,
});

const search = () => {
  router.get(route("home"), {search: form.search});
};
</script>

<template>
  <Head title=" - Latest Listings"/>

  <div class="flex items-center justify-center space-x-6 mb-4">
    <div class="w-1/2 mb-4">
      <form @submit.prevent="search">
        <InputField
            v-model="form.search"
            icon="magnifying-glass"
            label=""
            placeholder="Search..."
            type="search"
        />
      </form>
    </div>
  </div>

  <div v-if="Object.keys(props.listings.data).length">
    <div class="grid grid-cols-3 gap-4">
      <div v-for="listing in props.listings.data" :key="listing.id">
        <Card :listing="listing"/>
      </div>
    </div>

    <div class="mt-8">
      <PaginationLinks :paginator="listings"/>
    </div>
  </div>

  <div v-else>
    <p>No listings found</p>
  </div>
</template>
