<template>
    <FormLayout title="Cadastrar Jornada">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="nome" value="Nome" />
                    <ThrInput
                        id="nome"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="dia_semana" value="Dia da Semana" />
                    <ThrInput
                        id="dia_semana"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.dia_semana"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="nome_horario" value="Horário" />
                    <ThrInput
                        id="nome_horario"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome_horario"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('jornada.index')"
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
                dia_semana: "",
                nome_horario: "",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("jornada.store"));
        },
    },
};
</script>
