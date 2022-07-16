import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

import "./assets/css/main.css";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faPhone, faSearch } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPhone, faSearch);

const app = createApp(App);

app.use(router);

app.component("font-awesome-icon", FontAwesomeIcon).mount("#app");
