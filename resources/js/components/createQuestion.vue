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
export default {
    data() {
        return {
            question: {
                question: "",
                description: ""
            }
        };
    },
    methods: {
        async createQuestion() {
            let data = {
                question: this.question.question,
                description: this.question.description,
                api_token: window.api_token
            };
            try {
                const response = await axios.post("/api/questions", data);
                this.question.question = "";
                this.question.description = "";
            } catch (ex) {
                console.log(ex);
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
