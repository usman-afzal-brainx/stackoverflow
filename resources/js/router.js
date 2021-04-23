import Vue from "vue";
import VueRouter from "vue-router";
import questionComponent from "./components/questionComponent.vue";
import createQuestion from "./components/createQuestion.vue";
Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: "/", component: questionComponent },
        { path: "/question/create", component: createQuestion }
    ],
    mode: "history"
});
