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
    methods: {
        async handleLike(answer) {
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
        }
    }
};
</script>
