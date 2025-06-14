<template>
  <el-container>
    <el-aside class="sideMenu_con" width="200px"> <SideMenu /></el-aside>
    <el-container>
      <el-header class="header_con"></el-header>
      <el-main> <RouterView /></el-main>
    </el-container>
  </el-container>
</template>

<script>
import SideMenu from './components/SideMenu.vue'
export default {
  components: { SideMenu },
}
</script>

<style>
:root {
  --priColor: #0f8545;
  --secColor: #fff;
  --thirdColor: #3bd081;
}
#app,
html,
body {
  font-size: 16px !important;
}
ul {
  list-style: none;
}
.header_con,
.el-menu {
  background: #0f8545;
}

.is-active {
  background: var(--thirdColor) !important;
  color: var(--secColor) !important;
}
</style>
