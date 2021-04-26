<template>
    <button
        class="btn btn-danger btn-sm"
        @click="$emit('dislikeClicked', data)"
    >
        {{ data.no_thumbs_down }}
        <i class="far fa-thumbs-down"></i>
    </button>
</template>
<script>
export default {
    props: ["data"]
};
</script>
