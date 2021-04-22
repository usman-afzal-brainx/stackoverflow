<template>
    <div class="questions">
        <div class="container">
            <div class="question-section-title">
                <h1>All Questions</h1>
            </div>
            <div class="question-section-button">
                <button class="btn btn-primary">Ask a question</button>
            </div>
        </div>
        <div class="question" v-for="question in questions" :key="question.id">
            <div class="question-title">
                <h2>{{ question.question }}</h2>
            </div>
            <div class="description">
                <p>
                    {{ question.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            questions: []
        };
    },
    async created() {
        this.getQuestions();
    },
    methods: {
        async getQuestions() {
            const { data } = await axios.get("/api/questions", {
                headers: {
                    Authorization: "Bearer " + window.api_token,
                    Accept: "application/json"
                }
            });
            const questions = data.questions[0];
            this.questions = questions;
            console.log(data.questions[0]);
        }
    }
};
</script>

<style scoped>
.question {
    margin: 0px 35px 20px;
}
.description {
    width: 50%;
    margin: auto;
}
.question {
    text-align: center;
}
.question-section-title {
    display: inline-block;
}
.question-section-button {
    float: right;
}
</style>
