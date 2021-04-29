<template>
    <div class="buttons">
        <button
            :class="
                buttonAction === 'like'
                    ? 'btn btn-success btn-sm '
                    : 'btn btn-danger btn-sm '
            "
            @click="handleClick"
        >
            {{ count }}
            <i
                :class="
                    buttonAction === 'like'
                        ? 'far fa-thumbs-up'
                        : 'far fa-thumbs-down'
                "
            ></i>
        </button>
    </div>
</template>

<script>
export default {
    props: ["data", "buttonAction", "type", "id"],
    data() {
        return {
            count: this.data
        };
    },
    methods: {
        async handleQuestionLike() {
            const data = {
                question_id: this.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let count = this.count;
            try {
                this.count = count + 1;
                await axios.post("/api/questions/like", data);
            } catch (error) {
                console.log(error);
                this.count = count;
            }
        },
        async handleQuestionDislike() {
            const data = {
                question_id: this.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let count = this.count;
            try {
                this.count = count + 1;

                await axios.post("/api/questions/dislike", data);
            } catch (error) {
                console.log(error);
                this.count = count;
            }
        },
        async handleAnswerLike() {
            const data = {
                answer_id: this.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let count = this.count;
            try {
                this.count = count + 1;
                await axios.post("/api/answers/like", data);
            } catch (error) {
                console.log(error);
                this.count = count;
            }
        },
        async handleAnswerDislike() {
            const data = {
                answer_id: this.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let count = this.count;
            try {
                this.count = count + 1;
                await axios.post("/api/answers/dislike", data);
            } catch (error) {
                console.log(error);
                this.count = count;
            }
        },
        async handleClick() {
            this.$emit("buttonClick", this.buttonAction);
            if (this.buttonAction === "like") {
                if (this.type === "question") {
                    this.handleQuestionLike();
                } else {
                    this.handleAnswerLike();
                }
            } else {
                if (this.type === "question") {
                    this.handleQuestionDislike();
                } else {
                    this.handleAnswerDislike();
                }
            }
        }
    }
};
</script>
