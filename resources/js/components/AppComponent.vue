<template>
    <div class="container-fluid">
        <navbar :api_token="api_token"></navbar>
        <router-view></router-view>
    </div>
</template>

<script>
import navbar from "./navbar.vue";
export default {
    data() {
        return {
            api_token: window.localStorage.getItem("api_token")
        };
    },
    components: {
        navbar
    }
};
</script>
