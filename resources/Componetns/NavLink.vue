<script setup>

defineProps({
  routeName: String,
  componentName: String,
})
</script>

<template>

  <Link :class="{
    'bg-slate-700' : $page.component === componentName
  }" :href="route(routeName)" class="px-3 py-3 rounded-lg hover:bg-slate-700">
    <slot/>
  </Link>

</template>

<style scoped>

</style>