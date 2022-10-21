<template>
  <div>
    <nav class="navbar" v-if="role">
      <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost:8080/home">La Rustique</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <router-link to="/home"> <a class="nav-link" aria-current="page" href="#">Home</a></router-link>
              </li>
              <li class="nav-item">
                <router-link to="/klanten"><a class="nav-link" href="#">Klanten</a></router-link>
              </li>
              <li class="nav-item">
                <router-link to="/medewerkers"><a v-if="role == 'admin'" class="nav-link" href="#">Medewerkers</a>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/inkomstenOverzicht"><a class="nav-link" href="#" v-if="role == 'admin'">Inkomsten
                    overzicht</a></router-link>
              </li>
              <a class="nav-link" href="#" v-on:click="Uitloggen()">Uitloggen</a>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      role: sessionStorage.getItem("role"),
    };
  },
  methods: {
    Uitloggen() {
      sessionStorage.clear()
      location.href = '/'
    }
  }
}
</script>

<style>
.navbar {
  background-color: #2A9D8F;
}

.offcanvas-body {
  background-color: #264653;
  color: white;
}

.offcanvas-header {
  background-color: #264653;
  color: white;
}

.navbar a {
  color: white;
  font-weight: 700;
}

.uitloggen {
  margin-right: 2%;
}

a {
  text-decoration: none;
}
</style>