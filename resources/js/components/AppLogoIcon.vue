<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>
<template>
  <img src="/images/logo-delta-fishing.png" alt="Delta Fishing Logo" class="h-auto w-auto" />
</template>

