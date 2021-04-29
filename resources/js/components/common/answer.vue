<template>
    <div>
        <div class="answer-read">
            <div class="row">
                <div class="col-sm-2">
                    <div class="answer-left-part">
                        <div class="answer-count">
                            <p>
                                Votes:
                                {{ no_thumbs_up - no_thumbs_down }}
                            </p>
                        </div>
                        <div class="answer-thumbs-up">
                            <favorite-button
                                :data="no_thumbs_up"
                                :buttonAction="'like'"
                                :type="'answer'"
                                :id="id"
                                @buttonClick="handleCount"
                                v-if="user"
                            ></favorite-button>
                        </div>
                        <div class="answer-thumbs-down pt-1">
                            <favorite-button
                                :data="no_thumbs_down"
                                :buttonAction="'dislike'"
                                :type="'answer'"
                                :id="id"
                                @buttonClick="handleCount"
                                v-if="user"
                            ></favorite-button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7" v-if="!edit">
                    <div class="answer-content">
                        <div class="answer-description">
                            <p>
                                {{ answer.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-7 pt-1" v-if="edit">
                    <form @submit.prevent="handleSubmit(answer)">
                        <textarea
                            class="form-control rounded-0"
                            id="description"
                            rows="8"
                            v-model="description"
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
                        v-if="user_id === user.id && !edit"
                    >
                        Edit <i class="far fa-edit"></i>
                    </button>
                    <button
                        class="btn btn-danger delete-button"
                        @click="$emit('deleteClicked', answer)"
                        v-if="user_id === user.id || user.is_Admin === 'admin'"
                    >
                        Delete <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import favoriteButton from "../common/favoriteButton.vue";
import getUser from "../../user.js";
export default {
    props: ["answer"],
    components: {
        favoriteButton
    },
    data() {
        return {
            id: this.answer.id,
            user: "",
            edit: false,
            no_thumbs_up: this.answer.no_thumbs_up,
            no_thumbs_down: this.answer.no_thumbs_down,
            user_id: this.answer.user_id,
            description: this.answer.description
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
            let payload = {
                id: answer.id,
                user_id: this.user.id,
                question_id: answer.question_id,
                description: this.description,
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
        },
        handleCount(action) {
            if (action === "like") this.no_thumbs_up += 1;
            else this.no_thumbs_down += 1;
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
