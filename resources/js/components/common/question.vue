<template>
    <div class="row">
        <div class="col-sm-2">
            <div class="question-count">
                <p>
                    Votes:
                    {{ question.no_thumbs_up - question.no_thumbs_down }}
                </p>
            </div>
            <div class="question-thumbs-up" v-if="user">
                <favorite-button
                    :data="question.no_thumbs_up"
                    :buttonAction="'like'"
                    :type="'question'"
                    :id="question.id"
                ></favorite-button>
            </div>
            <div class="question-thumbs-down pt-1" v-if="user">
                <favorite-button
                    :data="question.no_thumbs_down"
                    :buttonAction="'dislike'"
                    :type="'question'"
                    :id="question.id"
                ></favorite-button>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="question-content" @click="handleClick(question)">
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
                <div class="question-edit">
                    <button
                        class="btn btn-primary"
                        @click="handleEdit(question)"
                        v-if="user.id === question.user_id"
                    >
                        Edit <i class="far fa-edit"></i>
                    </button>
                </div>
                <div class="question-delete">
                    <button
                        class="btn btn-danger"
                        @click="$emit('deleteClicked', question)"
                        v-if="
                            user.id === question.user_id ||
                                user.is_Admin === 'admin'
                        "
                    >
                        Delete <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import questionLikeButton from "../questionLikeButton.vue";
import questionDislikeButton from "../questionDislikeButton.vue";
import favoriteButton from "./favoriteButton.vue";
export default {
    components: { questionDislikeButton, questionLikeButton, favoriteButton },
    props: ["question", "user"],
    methods: {
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
.question-content:hover {
    cursor: pointer;
}
.description {
    width: 50%;
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
</style>
