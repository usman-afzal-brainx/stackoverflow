import Vue from "vue";
import VueRouter from "vue-router";
import questionComponent from "./components/questionComponent.vue";
import createQuestion from "./components/createQuestion.vue";
import showQuestion from "./components/showQuestion.vue";
Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: "/", component: showQuestion },
        { path: "/question/create", component: createQuestion }
    ],
    mode: "history"
});
