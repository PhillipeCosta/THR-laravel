<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-2
      bg-red-800
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      tracking-widest
      hover:bg-red-700
      active:bg-red-900
      focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
      transition
      ease-in-out
      duration-150
    "
  >
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
};
</script>
