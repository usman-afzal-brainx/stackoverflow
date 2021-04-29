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
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
                    <form @submit.prevent="createAnswer">
                        <div class="mb-3">
                            <label for="description" class="form-label"
                                >Add Answer to this Question</label
                            >
                            <textarea
                                class="form-control rounded-0"
                                id="description"
                                rows="8"
                                v-model="description"
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
import questionLikeButton from "./questionLikeButton.vue";
import questionDislikeButton from "./questionDislikeButton.vue";
import answers from "./answers.vue";
import question from "./common/question";
import getUser from "../user";
export default {
    components: {
        questionLikeButton,
        questionDislikeButton,
        answers,
        question
    },
    data() {
        return {
            question: {
                question: this.$route.params.question.question,
                description: this.$route.params.question.description,
                no_thumbs_up: this.$route.params.question.no_thumbs_up,
                no_thumbs_down: this.$route.params.question.no_thumbs_down
            },
            isAnswers: false,
            description: "",
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
        async createAnswer() {
            let payload = {
                user_id: this.user.id,
                question_id: this.$route.params.id,
                description: this.description,
                api_token: window.localStorage.getItem("api_token")
            };
            try {
                const { data } = await axios.post("/api/answers", payload);
                this.answers.push(data.answer[0]);
                this.description = "";
                this.isAnswers = true;
            } catch (ex) {
                console.log(ex);
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
