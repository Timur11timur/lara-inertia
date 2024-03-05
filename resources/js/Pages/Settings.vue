<template>
  <h1 class="text-3xl">Settings</h1>

  <div style="margin-top: 600px">
    <p>The current time is {{ time }}</p>

    <Link href="/settings" class="text-blue-500" preserve-scroll>
      Refresh
    </Link>
  </div>
</template>

<!--<script>-->
<!--import {Link} from "@inertiajs/vue3";-->
<!--import Layout from "../Shared/Layout.vue";-->

<!--export default {-->
<!--  components: {Layout, Link},-->
<!--  props: {time: String},-->
<!--};-->
<!--</script>-->

<script>
import Layout from '../Shared/Layout.vue'

export default {
  layout: Layout,
}
</script>

<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
  time: String
});
</script>
