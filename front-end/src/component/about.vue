<template>
  <div id="app">
    <fs-navbar/>
    <main>
      <router-view/>
    </main>
  </div>
</template>

<style scoped lang="scss">

</style>

<script>
import About from './About.vue';
export default Vue.component()
</script>