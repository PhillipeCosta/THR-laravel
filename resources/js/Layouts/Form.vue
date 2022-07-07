<template>
    <!--<Modal></Modal>-->
    <Head :title="title" />
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight mb-3"
                >
                    {{ title }}
                </h2>
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
import Modal from "@/Components/Global/Modal.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { onUnmounted } from "vue";

export default {
    components: {
        Modal,
        Head,
    },
    data() {
        return {
            next: false,
            modal: false,
        };
    },
    setup() {
        onUnmounted(
            Inertia.on("before", (event) => {
                /*if (!confirm("Are you sure you want to navigate away?")) {
                    event.preventDefault();
                }*/
            })
        );
    },
    props: {
        title: String,
    },
    watch: {
        "$page.url": function (next, to) {
            /*this.modal = true;*/
        },
    },
};
</script>
