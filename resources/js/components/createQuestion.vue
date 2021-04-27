<template>
    <div class="container">
        <div class="ask-question">
            <h1>Ask Question</h1>
            <div class="row">
                <div class="col-sm-8">
                    <form @submit.prevent="createQuestion">
                        <div class="mb-3">
                            <label for="title" class="form-label"
                                >Question</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                v-model="question.question"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"
                                >Desciption</label
                            >
                            <textarea
                                class="form-control rounded-0"
                                id="description"
                                rows="8"
                                v-model="question.description"
                            ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import getUser from "../user.js";
export default {
    data() {
        return {
            question: {
                question: "",
                description: ""
            },
            user: ""
        };
    },
    async created() {
        this.checkEdit();
        const user = await getUser();
        this.user = user;
    },
    methods: {
        async createQuestion() {
            let payload = {
                question: this.question.question,
                description: this.question.description,
                no_thumbs_up: 0,
                no_thumbs_down: 0,
                api_token: window.localStorage.getItem("api_token"),
                user_id: this.user.id
            };
            if (this.$route.params.question) {
                payload.id = this.$route.params.question.id;
                payload.no_thumbs_up = this.$route.params.question.no_thumbs_up;
                payload.no_thumbs_down = this.$route.params.question.no_thumbs_down;
            }
            console.log(payload);
            try {
                await axios.post("/api/questions", payload);
                this.question.question = "";
                this.question.description = "";
            } catch (ex) {
                console.log(ex);
            }
            this.$router.push({ path: "/" });
        },
        checkEdit() {
            if (this.$route.params.question) {
                this.question.question = this.$route.params.question.question;
                this.question.description = this.$route.params.question.description;
            }
        }
    }
};
</script>

<style scoped>
.ask-question {
    padding-top: 20px;
}
</style>
