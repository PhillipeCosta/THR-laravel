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
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <ThrLabel value="Cliente" />
                            <Select
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.id_cliente"
                                required
                                :options="selectClientes"
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
                            Atualizar
                        </ThrButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ThrButton from "@/Components/Button.vue";
import ThrInput from "@/Components/Input.vue";
import Switch from "@/Components/Switch.vue";
import ThrLabel from "@/Components/Label.vue";
import Select from "@/Components/Select.vue";
import LinkButton from "@/Components/LinkButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Switch,
        Select,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },

    setup(props) {
        const form = useForm({
            lotacao: props.item.lotacao,
            id_cliente: props.item.id_cliente,
            ativo: props.item.ativo == 1 ? true : false,
        });

        return { form };
    },
    computed: {
        selectClientes() {
            return this.clientes.map((item) => {
                const obj = {
                    value: item.id_cliente,
                    label: item.cliente,
                };
                return obj;
            });
        },
    },
    data() {
        return {};
    },
    props: {
        item: Object,
        clientes: Array
    },
    methods: {
        submit() {
            this.form.put(this.route("lotacao.update", this.item.id_lotacao), {
                //onFinish: () => this.form.reset("password", "password_confirmation"),
            });
        },
    },
};
</script>
