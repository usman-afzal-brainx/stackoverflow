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
        async handleClick() {
            this.$emit("buttonClick", this.buttonAction);
            let count = this.count;
            const data = {
                api_token: window.localStorage.getItem("api_token")
            };
            const path = `/api/${this.type}s/favorite`;
            if (this.type === "question") data.question_id = this.id;
            else data.answer_id = this.id;

            if (this.buttonAction === "like") data.action = "like";
            else data.action = "dislike";
            try {
                this.count += 1;
                await axios.post(path, data);
            } catch (error) {
                console.log(error);
                this.count = count;
            }
        }
    }
};
</script>
