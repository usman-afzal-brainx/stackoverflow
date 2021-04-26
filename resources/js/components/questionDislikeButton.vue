<template>
    <dislike-button
        :data="data"
        @dislikeClicked="handleDislike"
    ></dislike-button>
</template>

<script>
import dislikeButton from "./common/dislikeButton.vue";

export default {
    props: ["data"],
    components: {
        dislikeButton
    },
    data() {
        return {
            question: {
                no_thumbs_down: ""
            }
        };
    },
    methods: {
        async handleDislike(question) {
            const data = {
                api_token: window.api_token
            };
            let no_thumbs_down = question.no_thumbs_down;
            try {
                this.data.no_thumbs_down = no_thumbs_down + 1;

                await axios.post(`/api/questions/${question.id}/dislike`, data);
            } catch (error) {
                console.log(error);
                this.data.no_thumbs_down = no_thumbs_down;
            }
        }
    }
};
</script>
