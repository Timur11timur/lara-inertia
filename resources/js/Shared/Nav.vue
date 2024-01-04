<template>
  <nav class="mt-6">
    <ul class="list-disc">
      <li>
        <NavLink href="/" :active="$page.component === 'Home'">Home</NavLink>
      </li>
      <li>
        <NavLink href="/users" :active="$page.component === 'Users'">Users</NavLink>
      </li>
      <li>
        <NavLink href="/settings" :active="$page.component === 'Settings'">Settings</NavLink>
      </li>
      <li><Link href="/logout" method="post" class="text-blue-500 hover:underline">Log out</Link></li>
<!--      a link can be opened with command click on a new tab, but button can't-->
      <li><Link href="/logout" method="post" as="button" class="text-blue-500 hover:underline">Log out</Link></li>
      <li><Link href="/pass-data" method="post" :data="{ foo: 'bar' }" as="button" class="text-blue-500 hover:underline">Pass data</Link></li>
    </ul>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import NavLink from "./NavLink.vue";

export default {
  components: {NavLink, Link },
};
</script>