<template>
  <h1 class="text-4xl font-bold">Settings</h1>

  <Nav />

  <div style="margin-top: 500px">
    <p>The current time is {{ time }}</p>

    <Link href="/settings" class="text-blue-500" preserve-scroll>
      Refresh
    </Link>

  </div>
</template>

<script>
import Nav from "../Shared/Nav.vue";
import {Link} from "@inertiajs/vue3";

export default {
  components: { Nav, Link },
  props: { time: String },
};
</script>
