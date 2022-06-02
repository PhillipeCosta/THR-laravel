<template>
    <label class="flex relative items-center mb-4 cursor-pointer">
        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
            class="sr-only"
        />
        <div
            class="
                w-11
                h-6
                bg-gray-200
                rounded-full
                border border-gray-200
                toggle-bg
                dark:bg-gray-700 dark:border-gray-600
            "
        ></div>
    </label>
</template>

<script>
export default {
    emits: ["update:checked"],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
};
</script>
