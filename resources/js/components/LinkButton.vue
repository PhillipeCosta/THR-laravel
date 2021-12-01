<template>
  <Link
    class="
      inline-flex
      items-center
      px-4
      py-2
      border border-transparent
      rounded-md
      font-semibold
      text-xs 
      text-white
      tracking-widest
      focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
      transition
      ease-in-out
      duration-150
    "
  >
    <slot />
  </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
};
</script>
