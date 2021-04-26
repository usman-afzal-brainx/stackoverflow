<template>
    <button class="btn btn-success btn-sm" @click="$emit('likeClicked', data)">
        {{ data.no_thumbs_up }}
        <i class="far fa-thumbs-up"></i>
    </button>
</template>

<script>
export default {
    props: ["data"]
};
</script>
