<template>
  <span v-if="value">% {{ formatted }}</span>
</template>

<script>
export default {
  props: ["value"],
  computed: {
    formatted() {
      // Create our number formatter.
      var formatter = new Intl.NumberFormat("pt-BR", {
        
        currency: "BRL",

        // These options are needed to round to whole numbers if that's what you want.
        //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
        //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
      });

      return formatter.format(this.value);
    },
  },
};
</script>
