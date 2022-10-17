<template>
  <NavBar/>
  <router-view/>
  <!-- <InLoggen/> -->
</template>

<script>
// import InLoggen from "./components/InLoggen.vue";

import NavBar from "./components/items/NavBar.vue";


export default {
  name: 'App',
  components: {
    // InLoggen,
    
    NavBar
}
}
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap');

  *{
    font-family: 'Josefin Sans', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-size: 2.2vh;
  }

</style>
