<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <ThrLabel for="nome_grupo" value="Nome do Grupo" />
                            <ThrInput
                                id="nome_grupo"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.nome_grupo"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel
                                for="descricao"
                                value="Descrição do Feriado"
                            />
                            <ThrInput
                                id="descricao"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.descricao"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel for="data_feriado" value="Data" />
                            <ThrInput
                                id="data_feriado"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.data_feriado"
                                required
                                autofocus
                            />
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <LinkButton
                            class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                            :href="route('feriado.index')"
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
            </div>
        </div>
    </div>
</template>

<script>
import ThrButton from "@/Components/Global/Button.vue";
import ThrInput from "@/Components/Global/Input.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

export default {
    components: {
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },
    data() {
        return {
            form: this.$inertia.form({
                nome_grupo: '',
                descricao: '',
                data_feriado: '',
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("feriado.store"));
        },
    },
};
</script>
