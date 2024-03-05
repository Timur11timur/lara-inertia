<template>
  <GlobalLink
        href="/"
        class="text-blue-500 hover:underline"
        :class="{'font-bold underline': active}"
      ><slot /></GlobalLink>
</template>

<script>
export default {
  props: {
    active: Boolean
  }
};
</script>