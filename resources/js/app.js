import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import ck from "@ckeditor/ckeditor5-vue";
const appName =
  window.document.getElementsByTagName("title")[0]?.innerText || "K UI";

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => require(`./Pages/${name}.vue`),
  setup({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(ck)
      .mixin({ methods: { route } })
      .mount(el);
  },
});

InertiaProgress.init({ color: "#a855f7" });
