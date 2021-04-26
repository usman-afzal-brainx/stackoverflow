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
            <div class="row">
                <div class="col-sm-2">
                    <div class="question-left-part">
                        <div class="question-count">
                            <p>
                                Votes:
                                {{
                                    $route.params.question.no_thumbs_up -
                                        $route.params.question.no_thumbs_down
                                }}
                            </p>
                        </div>
                        <div class="question-thumbs-up">
                            <question-like-button
                                :data="$route.params.question"
                            ></question-like-button>
                        </div>
                        <div class="question-thumbs-down pt-1">
                            <question-dislike-button
                                :data="$route.params.question"
                            ></question-dislike-button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="question-content">
                        <div class="question-title">
                            <h2>{{ question.title }}</h2>
                        </div>
                        <div class="question-description">
                            <p>
                                {{ question.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
        <div class="answer-form">
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
import answerLikeButton from "./answerLikeButton";
import answerDislikeButton from "./answerDislikeButton";
import answers from "./answers.vue";
export default {
    components: {
        questionLikeButton,
        questionDislikeButton,
        answerLikeButton,
        answerDislikeButton,
        answers
    },
    data() {
        return {
            question: {
                title: this.$route.params.question.question,
                description: this.$route.params.question.description
            },
            isAnswers: false,
            description: ""
        };
    },
    created() {
        this.computeAnswersLength();
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
                description: this.description,
                api_token: window.api_token
            };
            try {
                const { data } = await axios.post(
                    `/api/answers/${this.$route.params.question.id}`,
                    payload
                );
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
