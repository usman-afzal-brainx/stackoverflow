<template>
    <div class="container-fluid">
        <div class="question">
            <div class="question-header">
                <div class="question-section-title">
                    <h1>Question</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="question-left-part">
                        <div class="question-count">
                            <p>
                                Votes:
                                {{
                                    question.no_thumbs_up -
                                        question.no_thumbs_down
                                }}
                            </p>
                        </div>
                        <div class="question-thumbs-up">
                            <button class="btn btn-success btn-sm">
                                {{ question.no_thumbs_up }}

                                <i class="far fa-thumbs-up"></i>
                            </button>
                        </div>
                        <div class="question-thumbs-down pt-1">
                            <button class="btn btn-danger btn-sm">
                                {{ question.no_thumbs_down }}

                                <i class="far fa-thumbs-down"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="question-content">
                        <div class="question-title">
                            <h2>{{ question.title }}</h2>
                        </div>
                        <div class="question-description">
                            <p>
                                {{ question.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="answers">
            <div class="answer-section-title">
                <div class="answer-header">
                    <h2>Answers</h2>
                </div>
            </div>
            <div class="answer">
                <div class="header"></div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="answer-left-part">
                            <div class="answer-count">
                                <p>
                                    Votes:
                                </p>
                            </div>
                            <div class="answer-thumbs-up">
                                <button class="btn btn-success btn-sm">
                                    <i class="far fa-thumbs-up"></i>
                                </button>
                            </div>
                            <div class="answer-thumbs-down pt-1">
                                <button class="btn btn-danger btn-sm">
                                    <i class="far fa-thumbs-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="answer-content">
                            <div class="answer-description">
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Voluptates laboriosam,
                                    modi error ipsa quas facilis iure a
                                    molestiae suscipit tempore sed consequuntur,
                                    porro doloremque ipsum optio, dolore neque
                                    unde aperiam!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            question: {
                title: this.$route.params.question.question,
                description: this.$route.params.question.description,
                no_thumbs_up: this.$route.params.question.no_thumbs_up,
                no_thumbs_down: this.$route.params.question.no_thumbs_down
            },
            answers: this.$route.params.question.answers
        };
    }
};
</script>

<style scoped>
.question {
    margin: 0px 20px 20px;
}
.question-thumbs-up,
.question-thumbs-down,
.question-edit,
.question-delete {
    display: inline-block;
    margin-right: 5px;
}
.question-count {
    font-size: 20px;
    font-weight: bold;
}
.question-count > p {
    margin: 0;
}
.question-left-part {
    margin-left: 50px;
}
.question-content {
    border-bottom: 1px solid;
    padding-bottom: 40px;
    border-color: rgb(166, 162, 151);
}
.answer-thumbs-up,
.answer-thumbs-down,
.answer-edit,
.answer-delete {
    display: inline-block;
    margin-right: 5px;
}
.answer-left-part {
    margin-left: 50px;
}
.answer-count {
    font-size: 20px;
    font-weight: bold;
}
.answer-count > p {
    margin: 0;
}
.answer-content {
    border-bottom: 1px solid;
    padding-bottom: 40px;
    border-color: rgb(166, 162, 151);
}
.answer-header {
    margin: 0px 30px 20px;
}
</style>
