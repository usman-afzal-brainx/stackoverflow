import Vue from "vue";
import VueRouter from "vue-router";
import questionComponent from "./components/questionListing.vue";
import createQuestion from "./components/createQuestion.vue";
import showQuestion from "./components/showQuestion.vue";
import login from "./components/login.vue";
import register from "./components/registerForm.vue";
import logout from "./components/logout.vue";
import AdminRegister from "./components/adminRegister.vue";
Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: "/", component: questionComponent },
        {
            path: "/question/create",
            name: "question.create",
            component: createQuestion
        },
        {
            path: "/question/:id",
            name: "question.show",
            component: showQuestion
        },
        {
            path: "/login",
            component: login
        },
        {
            path: "/register",
            component: register
        },
        {
            path: "/logout",
            component: logout
        },
        {
            path: "/admin/register",
            component: AdminRegister
        }
    ],
    mode: "history"
});
