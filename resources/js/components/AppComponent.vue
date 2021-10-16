<script>
  export default {
    components:{ 
      Headbar: () => import('./HeaderComponent') 
    }
  }
</script>

<template>
  <div class="app">
    <div class="header-bg">
      <Headbar class="app-view"></Headbar>
    </div>

    <router-view class="app-view"></router-view>
    
  </div>
</template>

<style scoped>
  .app{
    background-color: floralwhite;
    width: 100vw;
    height: 100vh
  }

  .app-view{
    width: 80vw;
    margin: 0 auto;
    padding: 20px;
  }

  .header-bg{
    background: #8823a8;
    color: #fff;
    
  }
</style>

