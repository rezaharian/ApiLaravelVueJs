<template>
  <!-- Bind Props ke komponen Header -->
  <Header v-bind:TextHeader="text" />
</template>
 
<script>
// Import komponen Header
import Header from "./components/Header";
 
export default {
  name: "App",
  components: {
    Header,
  },
  // Data Property
  data() {
    return {
      text: "Welcome To M Fikri",
    };
  },
};
</script>
 
<style>
</style>