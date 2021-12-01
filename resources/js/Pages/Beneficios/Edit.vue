<template>
  <div class="bg-gray-100">
    <div class="flex items-center container mx-auto h-screen">
      <div class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white">
        <form @submit.prevent="submit">
          <div class="grid grid-cols-3 gap-4">
            <div>
              <ThrLabel for="tipo_beneficio" value="Tipo do plano" />
              <ThrInput
                id="tipo_beneficio"
                type="text"
                class="mt-1 block w-full"
                v-model="form.tipo_beneficio"
                required
                autofocus
              />
            </div>
            <div>
              <ThrLabel for="beneficio" value="Empresa" />
              <ThrInput
                id="beneficio"
                type="text"
                class="mt-1 block w-full"
                v-model="form.beneficio"
                required
                autofocus
              />
            </div>
            <div>
              <ThrLabel for="de" value="Faixa idade início" />
              <ThrInput
                id="de"
                type="number"
                class="mt-1 block w-full"
                v-model="form.de"
                required
                autofocus
              />
            </div>
            <div>
              <ThrLabel for="de" value="Faixa idade fim" />
              <ThrInput
                id="ate"
                type="number"
                class="mt-1 block w-full"
                v-model="form.ate"
                required
                autofocus
              />
            </div>
            <div>
              <ThrLabel for="colaboracao_empresa" value="Colaboração empresa" />
              <currency-input
                id="colaboracao_empresa"
                class="mt-1 block w-full"
                v-model="form.colaboracao_empresa"
                required
                :options="moneyCurrencyOptions"
              />
            </div>
            <div>
              <ThrLabel for="desconto_dependente" value="Desconto dependente" />
              <currency-input
                id="desconto_dependente"
                class="mt-1 block w-full"
                v-model="form.desconto_dependente"
                required
                :options="moneyCurrencyOptions"
              />
            </div>
            <div>
              <ThrLabel for="inicio" value="Início" />
              <ThrInput
                id="inicio"
                type="date"
                class="mt-1 block w-full"
                v-model="form.inicio"
                required
                autofocus
              />
            </div>
            <div>
              <ThrLabel for="fim" value="Fim" />
              <ThrInput
                id="fim"
                type="date"
                class="mt-1 block w-full"
                v-model="form.fim"
                required
                autofocus
              />
            </div>
          </div>
          <div class="text-center mt-4">
            <LinkButton
              class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
              :href="route('beneficios.index')"
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
import CurrencyInput from "@/Components/CurrencyInput";
import ThrButton from "@/Components/Button.vue";
import ThrInput from "@/Components/Input.vue";
import ThrSelect from "@/Components/Select.vue";
import ThrLabel from "@/Components/Label.vue";
import LinkButton from "@/Components/LinkButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  components: {
    LinkButton,
    ThrButton,
    ThrInput,
    CurrencyInput,
    ThrSelect,
    ThrLabel,
  },

  setup(props) {
    const form = useForm({
        tipo_beneficio: props.beneficio.tipo_beneficio,
        beneficio: props.beneficio.beneficio,
        de: props.beneficio.de,
        ate: props.beneficio.ate,
        colaboracao_empresa: props.beneficio.colaboracao_empresa,
        desconto_dependente: props.beneficio.desconto_dependente,
        inicio: new Date(props.beneficio.inicio).toISOString().substring(0, 10),
        fim: new Date(props.beneficio.fim).toISOString().substring(0, 10),
        nome_pessoa_registro: props.beneficio.nome_pessoa_registro
    });

    return { form };
  },

  data() {
    return {
      moneyCurrencyOptions: {
        locale: "pt-BR",
        currency: "BRL",
        currencyDisplay: "hidden",
        valueRange: undefined,
        precision: 2,
        hideCurrencySymbolOnFocus: false,
        hideGroupingSeparatorOnFocus: false,
        hideNegligibleDecimalDigitsOnFocus: false,
        autoDecimalDigits: true,
        exportValueAsInteger: false,
        autoSign: true,
        useGrouping: true,
      },
    };
  },
  props: {
    beneficio: Object,
  },
  methods: {
    submit() {
      this.form.put(this.route("beneficios.update", this.beneficio.id_beneficio), {
        //onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
