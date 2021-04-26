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
                <div class="row">
                    <div class="col-sm-2">
                        <div class="question-count">
                            <p>
                                Votes:
                                {{
                                    question.no_thumbs_up -
                                        question.no_thumbs_down
                                }}
                            </p>
                        </div>
                        <div class="question-thumbs-up">
                            <question-like-button
                                :data="question"
                            ></question-like-button>
                        </div>
                        <div class="question-thumbs-down pt-1">
                            <question-dislike-button
                                :data="question"
                            ></question-dislike-button>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div
                            class="question-content"
                            @click="handleClick(question)"
                        >
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
                    <div class="col-sm-3">
                        <div class="manipulation-buttons">
                            <div class="question-edit" v-if="editAble">
                                <button
                                    class="btn btn-primary"
                                    @click="handleEdit(question)"
                                >
                                    Edit <i class="far fa-edit"></i>
                                </button>
                            </div>
                            <div class="question-delete" v-if="deleteAble">
                                <button
                                    class="btn btn-danger"
                                    @click="handleDelete(question)"
                                >
                                    Delete <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import questionLikeButton from "./questionLikeButton.vue";
import questionDislikeButton from "./questionDislikeButton.vue";
export default {
    components: { questionDislikeButton, questionLikeButton },
    data() {
        return {
            questions: [],
            editAble: true,
            deleteAble: false
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
                        Authorization: "Bearer " + window.api_token,
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
        },
        handleClick(question) {
            this.$router.push({
                name: "question.show",
                params: { id: question.id, question }
            });
        },
        handleEdit(question) {
            this.$router.push({
                name: "question.create",
                params: { question }
            });
        }
    }
};
</script>

<style scoped>
.question {
    margin: 0px 35px 20px;
}
.question-content:hover {
    cursor: pointer;
}
.description {
    width: 50%;
}

.question-section-title {
    display: inline-block;
}
.question-section-button {
    float: right;
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
}
.question-count > p {
    margin: 0;
}
.question-content {
    margin-top: 15px;
}
.manipulation-buttons {
    margin-top: 30px;
}
.header {
    margin: 0 30px 20px;
}
</style>
