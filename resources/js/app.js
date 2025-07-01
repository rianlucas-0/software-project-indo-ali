import './bootstrap';
import { createApp } from "vue";
import App from "./components/App.vue";
import MainHeader from "./components/MainHeader.vue"

createApp(App).mount("#app");
createApp(MainHeader).mount("#main-header");