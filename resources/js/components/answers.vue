<template>
    <div>
        <div class="answers">
            <div class="answer-section-title">
                <div class="answer-header">
                    <h2>Answers</h2>
                </div>
            </div>
            <div class="answer" v-for="answer in answers" :key="answer.id">
                <answer :answer="answer"></answer>
            </div>
        </div>
    </div>
</template>
<script>
import answer from "./common/answer.vue";
export default {
    props: ["data"],
    data() {
        return {
            answers: this.data
        };
    },
    components: {
        answer
    },
    watch: {
        data() {
            return (this.answers = this.data);
        }
    },
    methods: {
        async handleDelete(answer) {
            this.$emit("deleteClicked", answer);
        }
    }
};
</script>
<style scoped>
.answer-header {
    margin: 0px 30px 20px;
}

.question-section-title {
    display: inline-block;
}
</style>
