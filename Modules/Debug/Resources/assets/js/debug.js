import Index from "./index.vue";

window.Vue = require("vue");

import SuiVue from "semantic-ui-vue";
import PortalVue from "portal-vue";

import "semantic-ui-css/semantic.min.css";

Vue.component("index", require("./index.vue").default);

Vue.use(PortalVue);
Vue.use(SuiVue);

const app = new Vue({
  el: "#app",
  components: {
    Index: Index,
  },
});
