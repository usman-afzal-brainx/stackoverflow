<template>
    <div class="buttons">
        <button
            :class="
                action === 'like'
                    ? 'btn btn-success btn-sm '
                    : 'btn btn-danger btn-sm '
            "
            @click="handleClick"
        >
            <i
                :class="
                    action === 'like'
                        ? 'far fa-thumbs-up'
                        : 'far fa-thumbs-down'
                "
            ></i>
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            action: "like",
            type: "answer"
        };
    },
    methods: {
        async handleQuestionLike(question) {
            console.log("Question like");
            const data = {
                question_id: question.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let no_thumbs_up = question.no_thumbs_up;
            try {
                this.data.no_thumbs_up = no_thumbs_up + 1;
                await axios.post("/api/questions/like", data);
            } catch (error) {
                console.log(error);
                this.data.no_thumbs_up = no_thumbs_up + 1;
            }
        },
        async handleQuestionDislike(question) {
            console.log("Question dislike");

            const data = {
                question_id: question.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let no_thumbs_down = question.no_thumbs_down;
            try {
                this.data.no_thumbs_down = no_thumbs_down + 1;

                await axios.post("/api/questions/dislike", data);
            } catch (error) {
                console.log(error);
                this.data.no_thumbs_down = no_thumbs_down;
            }
        },
        async handleAnswerLike(answer) {
            console.log("Answer like");

            const data = {
                answer_id: answer.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let no_thumbs_up = answer.no_thumbs_up;
            try {
                this.data.no_thumbs_up = no_thumbs_up + 1;
                await axios.post("/api/answers/like", data);
            } catch (error) {
                console.log(error);
                this.data.no_thumbs_up = no_thumbs_up + 1;
            }
        },
        async handleAnswerDislike(answer) {
            console.log("Answer dislike");

            const data = {
                answer_id: answer.id,
                api_token: window.localStorage.getItem("api_token")
            };
            let no_thumbs_down = answer.no_thumbs_down;
            try {
                this.data.no_thumbs_down = no_thumbs_down + 1;

                await axios.post("/api/answers/dislike", data);
            } catch (error) {
                console.log(error);
                this.data.no_thumbs_down = no_thumbs_down;
            }
        },
        async handleClick() {
            if (this.action === "like") {
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
