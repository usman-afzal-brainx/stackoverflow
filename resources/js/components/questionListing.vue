<template>
    <div class="questions">
        <div class="container-fluid">
            <div class="header">
                <div class="question-section-title">
                    <h1>All Questions</h1>
                </div>
                <div class="question-section-button">
                    <button class="btn btn-primary" @click="handleAskQuestion">
                        Ask a question
                    </button>
                </div>
            </div>

            <div
                class="question"
                v-for="question in questions"
                :key="question.id"
            >
                <question
                    :question="question"
                    @deleteClicked="handleDelete"
                ></question>
            </div>
            <div class="no-questions-error" v-if="questions.length === 0">
                <h4>There are no questions in database</h4>
            </div>
        </div>
    </div>
</template>

<script>
import question from "./common/question.vue";
export default {
    components: { question },
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
            try {
                const { data } = await axios.get("/api/questions", {
                    headers: {
                        Authorization:
                            "Bearer " +
                            window.localStorage.getItem("api_token"),
                        Accept: "application/json"
                    }
                });
                const questions = data.questions[0];
                this.questions = questions;
            } catch (error) {
                console.log(error);
            }
        },

        async handleDelete(question) {
            const originalQuestions = { ...this.questions };
            try {
                const questions = this.questions.filter(
                    q => q.id !== question.id
                );
                this.questions = questions;
                await axios.delete(`/api/questions/${question.id}/`, {
                    headers: {
                        Authorization:
                            "Bearer " +
                            window.localStorage.getItem("api_token"),
                        Accept: "application/json"
                    }
                });
            } catch (error) {
                this.questions = originalQuestions;
                console.log(error);
            }
        },
        handleAskQuestion() {
            this.$router.push({ path: "/question/create" });
        }
    }
};
</script>

<style scoped>
.header {
    margin: 0 30px 20px;
}
.question {
    margin: 0px 35px 20px;
}
.question-section-title {
    display: inline-block;
}
.question-section-button {
    float: right;
}
</style>
