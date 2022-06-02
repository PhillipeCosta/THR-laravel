<template>
    <span v-if="value">{{ formatted }}</span>
</template>

<script>
export default {
    props: ["value"],
    computed: {
        formatted() {
            const date = new Date(this.value);
            return new Intl.DateTimeFormat("pt-BR", {
                timeZone: "UTC",
            }).format(date);
        },
    },
};
</script>
