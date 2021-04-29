<template>
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
</template>
<script>
export default {
    props: ["user_id", "question_id"],
    data() {
        return {
            description: ""
        };
    },
    methods: {
        async createAnswer() {
            let payload = {
                user_id: this.user_id,
                question_id: this.question_id,
                description: this.description,
                api_token: window.localStorage.getItem("api_token")
            };
            try {
                const { data } = await axios.post("/api/answers", payload);
                this.$emit("answerCreated", data.answer[0]);
                this.description = "";
                this.isAnswers = true;
            } catch (ex) {
                console.log(ex);
            }
        }
    }
};
</script>
