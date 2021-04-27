<template>
    <div>
        <div class="answer-read">
            <div class="row">
                <div class="col-sm-2">
                    <div class="answer-left-part">
                        <div class="answer-count">
                            <p>
                                Votes:
                                {{
                                    answer.no_thumbs_up - answer.no_thumbs_down
                                }}
                            </p>
                        </div>
                        <div class="answer-thumbs-up">
                            <answer-like-button
                                v-if="user"
                                :data="answer"
                            ></answer-like-button>
                        </div>
                        <div class="answer-thumbs-down pt-1">
                            <answer-dislike-button
                                v-if="user"
                                :data="answer"
                            ></answer-dislike-button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8" v-if="!edit">
                    <div class="answer-content">
                        <div class="answer-description">
                            <p>
                                {{ answer.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 pt-1" v-if="edit">
                    <form @submit.prevent="handleSubmit(answer)">
                        <textarea
                            class="form-control rounded-0"
                            id="description"
                            rows="8"
                            v-model="answer.description"
                        ></textarea>
                        <button class="btn btn-primary mt-2 mb-3">
                            Update
                        </button>
                    </form>
                </div>
                <div class="col-sm-2">
                    <button
                        class="btn btn-primary edit-button"
                        @click="handleEdit"
                        v-if="answer.user_id === user.id && !edit"
                    >
                        Edit <i class="far fa-edit"></i>
                    </button>
                    <button
                        class="btn btn-danger delete-button"
                        @click="$emit('deleteClicked', answer)"
                        v-if="
                            answer.user_id === user.id ||
                                user.is_Admin === 'admin'
                        "
                    >
                        Delete <i class="far fa-delete"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import answerLikeButton from "../answerLikeButton";
import answerDislikeButton from "../answerDislikeButton";
import getUser from "../../user.js";
export default {
    props: ["answer"],
    components: {
        answerLikeButton,
        answerDislikeButton
    },
    data() {
        return {
            user: "",
            edit: false
        };
    },
    async created() {
        if (window.localStorage.getItem("api_token")) {
            const user = await getUser();
            this.user = user;
        }
    },
    methods: {
        async handleSubmit(answer) {
            console.log(answer);
            this.description = answer.description;
            let payload = {
                id: answer.id,
                user_id: this.user.id,
                question_id: answer.question_id,
                description: answer.description,
                api_token: window.localStorage.getItem("api_token")
            };
            try {
                await axios.post("/api/answers", payload);
                this.answer.description = this.description;
                this.edit = false;
            } catch (ex) {
                console.log(ex);
            }
        },
        handleEdit() {
            this.edit = true;
        }
    }
};
</script>
<style scoped>
.answer-thumbs-up,
.answer-thumbs-down,
.edit-button,
.delete-button {
    display: inline-block;
    margin-right: 5px;
}
.answer-description {
    padding-top: 40px;
}
.answer-left-part {
    padding-top: 10px;
}

.answer-left-part {
    margin-left: 50px;
}
.answer-count {
    font-size: 20px;
    font-weight: bold;
}
.answer-count > p {
    margin: 0;
}
.answer-content {
    border-bottom: 1px solid;
    padding-bottom: 40px;
    border-color: rgb(166, 162, 151);
}
.edit-button,
.delete-button {
    margin-top: 40px;
}
</style>
