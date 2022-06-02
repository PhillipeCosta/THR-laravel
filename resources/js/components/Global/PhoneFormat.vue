<template>
    <span v-if="value" v-maska="">{{ formatted }}</span>
</template>

<script>
import { mask } from "maska";
export default {
    props: ["value"],
    computed: {
        formatted() {
            if (this.value.length == 11) {
                return mask(this.value, "(##) #####-####");
            } else {
                return mask(this.value, "(##) ####-####");
            }
        },
    },
};
</script>
