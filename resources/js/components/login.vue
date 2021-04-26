<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <h2>Login Form</h2>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email address</label
                        >
                        <input type="email" class="form-control" id="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="password"
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
<style scoped>
form {
    padding-top: 30px;
}
</style>
