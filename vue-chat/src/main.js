import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";
import "./index.css";
// fontAwesome
import FontAwesomeIcon from "./utilities/fontAwesome.js";

createApp(App)
  .use(createPinia())
  .use(router)
  .component("font-awesome-icon", FontAwesomeIcon)
  .mount("#app");
