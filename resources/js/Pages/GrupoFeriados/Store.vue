<template>
    <FormLayout title="Cadastrar Grupo de Feriados">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div>
                    <ThrLabel for="nome" value="Nome do Grupo" />
                    <ThrInput
                        id="nome"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('grupo-feriado.index')"
                >
                    Voltar
                </LinkButton>
                <ThrButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Cadastrar
                </ThrButton>
            </div>
        </form>
    </FormLayout>
</template>

<script>
import FormLayout from "@/Layouts/Form.vue";

import ThrButton from "@/Components/Global/Button.vue";
import ThrInput from "@/Components/Global/Input.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

export default {
    components: {
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },
    data() {
        return {
            form: this.$inertia.form({
                nome: "",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("grupo-feriado.store"));
        },
    },
};
</script>
