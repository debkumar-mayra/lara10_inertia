<template lang="">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

      <li class="nav-item active">

        <Link class="nav-link" href="/">Home</Link>

      </li>

      <li class="nav-item">
        <Link class="nav-link" href="/about">About</Link>
      </li> 

      <li class="nav-item">
        <Link class="nav-link" href="/login">Login</Link>
      </li>

<template v-if="$page.props.isLogin && $page.props.isUser">
      <li class="nav-item">
        <Link class="nav-link" href="/dashboard">Dashboard</Link>
      </li>

      <li class="nav-item">
        <Link class="nav-link" href="/profile">Profile</Link>
      </li>

      <li class="nav-item">
        <Link href="/logout" class="nav-link" method="post" as="button">Logout</Link>
      </li>
</template>

     
    </ul>
  </div>
</nav>
</template>
<script setup>
</script>
<style lang="">
    
</style>