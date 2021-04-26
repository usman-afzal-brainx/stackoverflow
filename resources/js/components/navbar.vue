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
                        <router-link class="nav-link" to="/question/create"
                            >Ask A Question</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login"
                            >Login</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/register"
                            >Register</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
