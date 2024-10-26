<script setup>
import {Head, router, useForm} from "@inertiajs/vue3";
import Card from "../Components/Card.vue";
import PaginationLinks from "../Components/PaginationLinks.vue";
import InputField from "../Components/InputField.vue";

const params = route().params;

const props = defineProps({
  listings: Object,
  searchTerm: String,
});

const form = useForm({
  search: props.searchTerm,
});

const search = () => {
  router.get(route("home"), {
    search: form.search,
    user_id: params.user_id,
    tag: params.tag,
  });
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
