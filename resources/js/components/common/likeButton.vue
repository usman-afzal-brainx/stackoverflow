<template>
    <button class="btn btn-success btn-sm" @click="handleLike(question)">
        {{ question.no_thumbs_up }}
        <i class="far fa-thumbs-up"></i>
    </button>
</template>

<script>
export default {
    data() {
        return {
            question: {
                no_thumbs_up: ""
            }
        };
    },
    methods: {
        async handleLike(question) {
            const data = {
                api_token: window.api_token
            };
            let no_thumbs_up = question.no_thumbs_up;
            const index = this.questions.indexOf(question);
            try {
                question.no_thumbs_up = no_thumbs_up + 1;
                this.questions[index] = question;
                await axios.post(`/api/questions/${question.id}/like`, data);
            } catch (error) {
                console.log(error);
                question.no_thumbs_up = no_thumbs_up;
                this.questions[index] = question;
            }
        }
    }
};
</script>
