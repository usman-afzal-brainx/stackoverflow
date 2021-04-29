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
        <div class="answers" v-if="isAnswers">
            <answers :answers="$route.params.question.answers"></answers>
        </div>
        <div class="answer-not-found-error" v-if="!isAnswers">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <p>
                        There are no answers for this question. Want to answer?
                        Go for it!
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
            isAnswers: false,
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
            this.answers.push(answer);
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
