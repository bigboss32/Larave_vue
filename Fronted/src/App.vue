<template>
<nav v-if="$route.meta.mostrarNav" class="navbar bg-green fixed-top">
  <div class="container-fluid">
    <div class="card-body">
    <div class="card">
      <div class="card-header">
        <h4>{{ $route.query.username }}</h4>
      </div>
    
    </div>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navegacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <router-link class="dropdown-item" to="/">Listar Proyectos</router-link>
          
          </li>
          <li class="nav-item">
        
            <router-link class="dropdown-item" :to="{ path: '/crearproyecto', query: { parametro1: $route.query.id_user, parametro2: $route.query.email } }">Crear Proyectos</router-link>

          </li>
        
     
          <button @click="salir">Cerrar sesión</button>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">

  
</div>
<router-view />
</template>

<script>
import axios from 'axios';

import router from './router';
export default {
  created() {
    axios.interceptors.request.use(config => {
      const token = localStorage.getItem('token');
      console.log(token+'de app')
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
      return config;
    });
  },
  methods: {
    salir() {
      localStorage.removeItem('token');
      router.push({ path: '/' });
    }
  }
}
</script>
