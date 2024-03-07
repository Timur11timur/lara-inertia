<template>
  <nav>
    <ul class="flex space-x-6">
      <li>
        <NavLink href="/" :active="$page.component === 'Home'">Home</NavLink>
      </li>
      <li>
        <NavLink href="/users" :active="['Users/Index', 'Users/Create'].includes($page.component)">Users</NavLink>
      </li>
      <li>
        <NavLink href="/settings" :active="$page.component === 'Settings'">Settings</NavLink>
      </li>
      <li><NavLink href="/logout" method="post">Log out link</NavLink></li>
<!--      a link can be opened with command click on a new tab, but button can't-->
      <li><NavLink href="/logout" method="post" as="button" class="hover:underline">Log out button</NavLink></li>
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