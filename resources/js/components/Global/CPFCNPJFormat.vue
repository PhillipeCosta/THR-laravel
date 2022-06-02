<template>
  <div
    class="masked-input text--pointer"
    @mouseover="toggleShowCpf"
    @mouseleave="toggleShowCpf"
  >
    {{ maskedValue }}
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      maskedItem: {},
      isCpf: false
    }
  },
  computed: {
    cpfMask() {
      return this.maskedItem.showCpf ? '$1.$2.$3-$4' : '***.***.$3-$4'
    },
    cnpjMask() {
      return this.maskedItem.showCpf ? '$1.$2.$3/$4-$5' : '***.***.***/$4-$5'
    },
    maskedValue() {
      return this.isCpf ? this.cpfMasked() : this.cnpjMasked()
    },
    cpfCnpjValue() {
      return this.maskedItem.cpf_cnpj || '12345678910'
    }
  },
  mounted() {
    this.maskedItem = Object.assign({ showCpf: false }, {cpf_cnpj: this.value})
    this.isCpf = this.cpfCnpjValue.length === 11
  },
  methods: {
    toggleShowCpf() {
      this.maskedItem.showCpf = !this.maskedItem.showCpf
    },
    cpfMasked() {
      return this.cpfCnpjValue.replace(
        /(\d{3})(\d{3})(\d{3})(\d{2})/,
        this.cpfMask
      )
    },
    cnpjMasked() {
      return this.cpfCnpjValue.replace(
        /^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/,
        this.cnpjMask
      )
    }
  }
}
</script>
<style scoped>
.masked-input {
  user-select: none;
  min-width: 127px; /* largura olhando CPF e CNPJ */
}
</style>
