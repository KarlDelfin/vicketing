<template>
  <el-menu class="sideMenu" :default-active="activeLink">
    <figure>
      <img src="../assets/images/company-logo.png" />
    </figure>
    <router-link to="/">
      <el-menu-item index="/"
        ><i class="bi bi-clipboard-data me-2"></i>
        <span>Home</span>
      </el-menu-item>
    </router-link>
    <router-link to="/enforcers">
      <el-menu-item index="/enforcers"
        ><i class="bi bi-people me-2"></i>
        <span>Enforcers</span>
      </el-menu-item>
    </router-link>
    <router-link to="/violations">
      <el-menu-item index="/violations"
        ><i class="bi bi-graph-up-arrow me-2"></i>
        <span>Violations</span>
      </el-menu-item>
    </router-link>
    <router-link to="/violation-articles">
      <el-menu-item index="/violation-articles"
        ><i class="bi bi-journals me-2"></i>
        <span>Violation Articles</span>
      </el-menu-item>
    </router-link>
    <!-- <router-link>
      <el-menu-item type="button" @click="logout()"
        ><i class="text-danger bi bi-power me-2"></i>
        <span>Logout</span>
      </el-menu-item>
    </router-link> -->
  </el-menu>
</template>
<script>
export default {
  data() {
    return {
      user: {},
      activeLink: '',
    }
  },
  methods: {
    logout() {
      console.log('LOGOUT')
    },
  },
  watch: {
    $route(to) {
      this.activeLink = to.path
    },
  },
  mounted() {
    this.activeLink = this.$route.path
  },
}
</script>

<style>
.sideMenu {
  min-height: 100vh;
}

.sideMenu figure {
  margin: 0;
}
.sideMenu figure img {
  max-width: 200px;
  width: 100%;
  padding: 20px;
}
a {
  color: inherit;
  text-decoration: none !important;
}
.el-menu-item {
  color: white;
  text-align: left;
  display: block;
}
.el-menu-item:hover {
  background: #3bd081;
}
a.router-link-active:nth-child(6) > li:nth-child(1) {
  margin: 100% 0 0 0;
}
</style>
