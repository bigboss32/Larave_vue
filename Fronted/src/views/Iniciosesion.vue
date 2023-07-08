<template>
    <div class="login-container">
      <div class="login-form">
        <h2 class="login-title">Iniciar sesión</h2>
        <form @submit="login">
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" v-model="email" required>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" v-model="password" required>
          </div>
          <button type="submit" class="login-button">Iniciar sesión</button>
          <li class="nav-item">
            <router-link  class="dropdown" to="/Registraseusuario">registrarse</router-link>
            
          
          </li>
        </form>
      </div>
    </div>
  </template>

<style>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.login-form {
  width: 300px;
  padding: 20px;
  background-color: #f1f1f1;
  border-radius: 5px;
}

.login-title {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.login-button {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.login-button:hover {
  background-color: #45a049;
}
</style>
<script>
import axios from 'axios';
import { mostraralerta, enviarsolicitud,Iniciosesion,sesion} from '../funciones';
import {useRoute} from 'vue-router';

export default {
  data() {
    return {
      email:'',
      password:'',
      url:'http://localhost:8000/api/v1/iniciar-sesion',
      cargando: false
    }
  },
  mounted(){
   
  },

  methods: {

    login() {
      event.preventDefault();

      this.cargando = true;

      var parametros = {
        email: this.email.trim(),
        password: this.password.trim(),
      };

      sesion(parametros, this.url, 'Inicio de sesión exitoso')
        
       
      
      }
   
  }
}
</script>