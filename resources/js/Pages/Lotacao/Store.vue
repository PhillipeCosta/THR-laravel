<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="
                    rounded
                    overflow-hidden
                    flex-grow
                    shadow-lg
                    p-10
                    bg-white
                "
            >
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <ThrLabel for="lotacao" value="Lotação" />
                        <ThrInput
                            id="lotacao"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.lotacao"
                            required
                            autofocus
                        />
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <ThrLabel value="Empresa" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_pessoa"
                                required
                                :options="selectEmpresa"
                            />
                        </div>
                        <div>
                            <ThrLabel value="Feriado" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_feriado"
                                required
                                :options="selectFeriado"
                            />
                        </div>
                        <div>
                            <ThrLabel value="Status" />
                            <Switch v-model:checked="form.ativo" />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <LinkButton
                            class="
                                hover:bg-gray-700
                                active:bg-gray-900
                                bg-gray-800
                                mr-3
                            "
                            :href="route('lotacao.index')"
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
import Switch from "@/Components/Global/Switch.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

export default {
    components: {
        Switch,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
    },

    data() {
        return {
            form: this.$inertia.form({
                lotacao: "",
                id_feriado: "",
                id_pessoa: "",
                ativo: false,
            }),
        };
    },
    props: {
        empresas: Array,
        feriados: Array,
    },
    computed: {
        selectEmpresa() {
            return this.empresas.map((item) => {
                const obj = {
                    value: item.id_pessoa,
                    label: item.razao_social,
                };
                return obj;
            });
        },
        selectFeriado() {
            return this.feriados.map((item) => {
                const obj = {
                    value: item.id_feriado,
                    label: item.nome_grupo,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("lotacao.store"));
        },
    },
};
</script>
