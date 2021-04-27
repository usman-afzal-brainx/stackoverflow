<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <h2>Register Form</h2>
                <form @submit.prevent="handleSubmit">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="user.name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            v-model="user.email"
                            required
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
                            v-model="user.password"
                            @change="clearPasswordError"
                            required
                        />
                        <div
                            class="error-message-password pt-1 pb-1"
                            v-if="err.password"
                        >
                            <p>{{ err.password }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmed" class="form-label"
                            >Confirm Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmed"
                            v-model="user.password_confirmed"
                            @change="clearConfirmPasswordError"
                            required
                        />
                    </div>
                    <div
                        class="error-message-password-confirmed pt-1 pb-1"
                        v-if="err.password_confirmed"
                    >
                        <p>{{ err.password_confirmed }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="userTypes" class="form-label"
                            >User Type</label
                        >
                        <select
                            name="userTypes"
                            id="userTypes"
                            v-model="user.is_Admin"
                        >
                            <option
                                v-for="userType in userTypes"
                                :key="userType.id"
                                :value="userType.type"
                                >{{ userType.type }}</option
                            >
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
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
            user: {
                name: "",
                email: "",
                password: "",
                is_Admin: "",
                password_confirmed: ""
            },
            err: {},
            userTypes: []
        };
    },
    async created() {
        this.getUserTypes();
    },
    methods: {
        async handleSubmit() {
            if (this.user.password.length < 6)
                this.err.password =
                    "Password must be atleast 6 characters long";
            if (this.user.password !== this.user.password_confirmed)
                this.err.password_confirmed = "Password does not match";

            if (!this.err.password_confirmed && !this.err.password) {
                try {
                    const response = await axios.post(
                        "/api/register",
                        this.user
                    );
                    this.user.name = "";
                    this.user.email = "";
                    this.user.password = "";
                    this.user.password_confirmed = "";
                    this.$router.push({ path: "/" });
                } catch (error) {
                    console.log(error);
                }
            }
        },
        clearPasswordError() {
            if (this.err.password) delete this.err.password;
        },
        clearConfirmPasswordError() {
            if (this.err.password_confirmed) delete this.err.password_confirmed;
        },
        async getUserTypes() {
            const { data } = await axios.get("/api/user/types", {
                headers: {
                    Authorization:
                        "Bearer " + window.localStorage.getItem("access_token"),
                    Accept: "application/json"
                }
            });
            const userTypes = data.userTypes[0];
            this.userTypes = userTypes;
        }
    }
};
</script>
<style scoped>
form {
    padding-top: 30px;
}
.error-message-password-confirmed,
.error-message-password {
    color: red;
}
</style>
