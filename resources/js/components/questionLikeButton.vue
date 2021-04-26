<template>
    <like-button :data="data" @likeClicked="handleLike"></like-button>
</template>

<script>
import likeButton from "./common/likeButton.vue";
export default {
    props: ["data"],
    components: {
        likeButton
    },
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
            try {
                this.data.no_thumbs_up = no_thumbs_up + 1;
                await axios.post(`/api/questions/${question.id}/like`, data);
            } catch (error) {
                console.log(error);
                this.data.no_thumbs_up = no_thumbs_up + 1;
            }
        }
    }
};
</script>
