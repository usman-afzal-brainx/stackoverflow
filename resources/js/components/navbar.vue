<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link class="navbar-brand" to="/">Stackoverflow</router-link>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link active" to="/"
                            >Home</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            to="/question/create"
                            v-if="api_token"
                            >Ask A Question</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="!api_token">
                        <router-link class="nav-link" to="/login"
                            >Login</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="!api_token">
                        <router-link class="nav-link" to="/register"
                            >Register</router-link
                        >
                    </li>
                    <li
                        class="nav-item"
                        v-if="api_token && user.is_Admin == 'admin'"
                    >
                        <router-link class="nav-link" to="/admin/register"
                            >Register User</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="api_token">
                        <router-link class="nav-link" to="/logout"
                            >Log Out</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
import getUser from "../user.js";
export default {
    props: ["api_token"],
    data() {
        return {
            user: ""
        };
    },
    async created() {
        const user = await getUser();
        this.user = user;
    }
};
</script>
