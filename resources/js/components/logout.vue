<template> </template>
<script>
export default {
    created() {
        this.logOut();
    },
    methods: {
        async logOut() {
            try {
                await axios.post("/api/logout");
                window.localStorage.removeItem("api_token");
                window.location.href = "/";
            } catch (ex) {
                console.log(ex);
            }
        }
    }
};
</script>
