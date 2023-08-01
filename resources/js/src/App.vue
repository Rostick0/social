<template>
  <div class="wrapper">
    <div class="wrapper__inner">
      <router-view />
    </div>
  </div>
</template>

<script setup>
</script>

<style lang="scss">
@import '@/app/styles/index.scss';

.wrapper {
  font-family: 'PT Sans';
  display: flex;
  flex-direction: column;
  min-height: 100vh;

  &__inner {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
}
</style>
