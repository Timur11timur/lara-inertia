<template>
  <div>
    <Component
      :is="link.url ? 'GlobalLink' : 'span'"
      v-for="link in links"
      :href="link.url"
      v-html="link.label"
      class="px-1"
      :class="{ 'text-gray-500': !link.url, 'font-bold': link.active }"
    ></Component>
  </div>
</template>

<script setup>
defineProps({
  links: Array
})
</script>