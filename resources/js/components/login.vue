<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <h2>Login Form</h2>
                <form @submit.prevent="login">
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            v-model="email"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            v-model="password"
                        />
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <router-link to="/register" class="pl-3"
                        >Create an Account</router-link
                    >
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: ""
        };
    },
    methods: {
        async login() {
            let payload = {
                email: this.email,
                password: this.password
            };
            try {
                const { data: token } = await axios.post("/api/login", payload);
                window.localStorage.setItem("api_token", token);
                window.location.href = "/";
            } catch (ex) {
                console.log(ex);
            }
        }
    }
};
</script>

<style scoped>
form {
    padding-top: 30px;
}
</style>
