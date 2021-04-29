<template>
    <div class="container-fluid">
        <div class="question">
            <div class="question-header">
                <div class="question-section-title">
                    <h1>Question</h1>
                </div>
                <div class="back-button">
                    <button class="btn btn-primary" @click="handleBack">
                        <i class="fas fa-long-arrow-alt-left"></i> Back
                    </button>
                </div>
            </div>
            <question
                :question="question"
                :user="user"
                :showManipulationButtons="false"
            ></question>
        </div>
        <div class="answers" v-if="answers">
            <answers :data="answers" @deleteClicked="handleDelete"></answers>
        </div>
        <div class="answer-not-found-error" v-if="!answers.length > 0">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" v-if="user">
                    <p>
                        There are no answers for this question. Want to answer?
                        Go for it!
                    </p>
                </div>
                <div class="col-sm-8" v-if="!user">
                    <p>
                        There are no answers for this question. Create an
                        Account to answer this question!
                    </p>
                </div>
            </div>
        </div>
        <div class="answer-form" v-if="user">
            <create-answer
                :user_id="user.id"
                :question_id="question.id"
                @answerCreated="handleAnswerCreation"
            ></create-answer>
        </div>
    </div>
</template>
<script>
import answers from "./answers.vue";
import question from "./common/question";
import createAnswer from "./common/createAnswer.vue";
import getUser from "../user";
export default {
    components: {
        answers,
        question,
        createAnswer
    },
    data() {
        return {
            question: {
                id: this.$route.params.id,
                question: this.$route.params.question.question,
                description: this.$route.params.question.description,
                no_thumbs_up: this.$route.params.question.no_thumbs_up,
                no_thumbs_down: this.$route.params.question.no_thumbs_down
            },
            answers: this.$route.params.question.answers,
            user: ""
        };
    },
    async created() {
        this.computeAnswersLength();
        if (window.localStorage.getItem("api_token")) {
            const user = await getUser();
            this.user = user;
        }
    },
    methods: {
        handleBack() {
            this.$router.push({ path: "/" });
        },
        computeAnswersLength() {
            this.isAnswers = true
                ? this.$route.params.question.answers.length > 0
                : false;
        },
        handleAnswerCreation(answer) {
            if (!answers) {
                const answers = [];
                answers.push(answer);
                console.log(answers);
                this.answers = answers;
            } else this.answers.push(answer);
        },
        async handleDelete(answer) {
            const originalAnswers = { ...this.answers };
            try {
                const answers = this.answers.filter(a => a.id !== answer.id);
                this.answers = answers;
                await axios.delete(`/api/answers/${answer.id}/`, {
                    headers: {
                        Authorization:
                            "Bearer " +
                            window.localStorage.getItem("api_token"),
                        Accept: "application/json"
                    }
                });
            } catch (error) {
                this.answers = originalAnswers;
                console.log(error);
            }
        }
    }
};
</script>

<style scoped>
.question {
    margin: 0px 20px 20px;
}
.question-thumbs-up,
.question-thumbs-down,
.question-edit,
.question-delete {
    display: inline-block;
    margin-right: 5px;
}
.question-count {
    font-size: 20px;
    font-weight: bold;
}
.question-count > p {
    margin: 0;
}
.question-left-part {
    margin-left: 50px;
}
.question-content {
    border-bottom: 1px solid;
    padding-bottom: 40px;
    border-color: rgb(166, 162, 151);
}
.back-button {
    float: right;
    margin-right: 100px;
}
.answer-not-found-error {
    font-size: 23px;
    font-weight: bold;
    padding-top: 10px;
}
.answer-form {
    padding-top: 30px;
    padding-bottom: 20px;
}
</style>
