<template>
    <button class="btn btn-danger btn-sm" @click="handleDislike(question)">
        {{ data.no_thumbs_down }}
        <i class="far fa-thumbs-down"></i>
    </button>
</template>

<script>
export default {
    props: ["data"],
    data() {
        return {
            question: {
                no_thumbs_up: ""
            }
        };
    },
    created() {
        console.log(data);
    },
    methods: {
        async handleDislike(question) {
            const data = {
                api_token: window.api_token
            };
            let no_thumbs_down = question.no_thumbs_down;
            const index = this.questions.indexOf(question);
            try {
                question.no_thumbs_down = no_thumbs_down + 1;
                this.questions[index] = question;
                await axios.post(`/api/questions/${question.id}/dislike`, data);
            } catch (error) {
                console.log(error);
                question.no_thumbs_down = no_thumbs_down;
                this.questions[index] = question;
            }
        }
    }
};
</script>
