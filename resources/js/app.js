import { createApp, h } from 'vue'
import {createInertiaApp, Link, Head} from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Layout from "./Shared/Layout.vue";

createInertiaApp({
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 250,

    // The color of the progress bar...
    color: '#29d',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: false,
  },
  // resolve: name => {
  //   const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
  //
  //   let page = pages[`./Pages/${name}.vue`].default;
  //
  //   // if (! page.layout) {
  //   //   page.layout = Layout;
  //   // }
  //
  //   page.layout ??= Layout;
  //
  //   return page;
  // },
  resolve: async (name) => {
    // Resolve the page component asynchronously
    const page = await resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/*.vue')
    );
    // Add the layout to the page component if there is no default layout set
    page.default.layout ??= Layout;
    // Return the page component
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("GlobalLink", Link)
      .component("Head", Head)
      .mount(el)
  },
  title: title => 'My app - ' + title
})