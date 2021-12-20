<template>
    <select
        class="
            bg-gray-50
            border border-gray-300
            text-gray-900 text-sm
            rounded-lg
            focus:ring-blue-500 focus:border-blue-500
            block
            w-full
            p-2.5
            dark:bg-gray-700
            dark:border-gray-600
            dark:placeholder-gray-400
            dark:text-white
            dark:focus:ring-blue-500
            dark:focus:border-blue-500
        "
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="select"
    >
    <option v-for="option in options" :key="option.value" :value="option.value">{{option.label}}</option>
    </select>
</template>

<script>
export default {
    props: {
        modelValue: {},
        options: {
            default: [],
        },
    },
    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
