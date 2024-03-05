<template>
  <GlobalLink
        href="/"
        class="text-black hover:underline"
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