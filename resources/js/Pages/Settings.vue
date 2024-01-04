<template>
  <h1>Settings</h1>

  <Nav />
</template>

<script>
import Nav from "../Shared/Nav.vue";
import {Link} from "@inertiajs/vue3";

export default {
  components: { Nav, Link },
  props: { time: String },
};
</script>
