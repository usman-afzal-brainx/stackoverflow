<template>
    <div class="container-fluid">
        <navbar></navbar>
        <router-view></router-view>
    </div>
</template>

<script>
import navbar from "./navbar.vue";
export default {
    components: {
        navbar
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
