<template>
<FlashMessages />
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
      <ThrButton
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Cadastrar
      </ThrButton>
    </div>
  </form>
</template>

<script>
import CurrencyInput from "@/Components/CurrencyInput";
import FlashMessages from "@/Components/FlashMessages";
import ThrButton from "@/Components/Button.vue";
import ThrInput from "@/Components/Input.vue";
import ThrSelect from "@/Components/Select.vue";
import ThrLabel from "@/Components/Label.vue";

export default {
  components: {
    ThrButton,
    ThrInput,
    CurrencyInput,
    FlashMessages,
    ThrSelect,
    ThrLabel
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
      form: this.$inertia.form({
        tipo_beneficio: "",
        beneficio: "",
        de: Number,
        ate: Number,
        colaboracao_empresa: Number,
        desconto_dependente: "",
        inicio: "",
        fim: "",
        nome_pessoa_registro: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("beneficios.store"), {
        //onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
