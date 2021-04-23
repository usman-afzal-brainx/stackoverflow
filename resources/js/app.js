import Vue from "vue";
import router from "./router";
import VueRouter from "vue-router";

require("./bootstrap");

Vue.use(VueRouter);

Vue.component(
    "app-component",
    require("./components/AppComponent.vue").default
);

const app = new Vue({
    el: "#app",
    router
});
