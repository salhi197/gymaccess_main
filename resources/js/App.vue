<template>
  <div id="app">
    <nav>
      <router-link to="/dashboard">Dashboard</router-link>
      <router-link to="/another-page">Another Page</router-link>
    </nav>
    <router-view></router-view> <!-- Routed views will be rendered here -->
  </div>
</template>

<script>
export default {
  name: 'App'
};
</script>

<style>
/* Your styles here */
</style>
