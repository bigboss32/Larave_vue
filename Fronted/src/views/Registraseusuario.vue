<template>
  <div class="registro-usuario">
    <h1>Crear Usuario</h1>
    <form @submit="crearUsuario">
      <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" id="name" v-model="name" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <button type="submit">Crear Usuario</button>
    </form>
  </div>
</template>
  
  <script>
  import axios from 'axios';
import { mostraralerta, enviarsolicitud,registarusu } from '../funciones';
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      url:'http://127.0.0.1:8000/api/v1/usuarios',
      cargando: false
    };
  },
  methods: {
    crearUsuario() {
      event.preventDefault();

      this.cargando = true;
      if (this.name.trim() === "") {
        mostraralerta("Ingrese un nombre", "warning", "nombre");
      } else if (this.email.trim() === "") {
        mostraralerta("Ingrese un correo", "warning", "correo valido");
      } else {
        var parametros = {
            name: this.name.trim(),
            email: this.email.trim(),
            password: this.password.trim(),
        };
        registarusu('POST', parametros, this.url, 'Proyecto creado');
      }
    },
  },
};
</script>
  
  <style>
.registro-usuario {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>