<template>
  <div>
    
    <table class="table" style="margin-top: 90px;"> <!-- Aplica el margen superior -->
      <thead>
        <tr>
          <th scope="col">#ind</th>
          <th scope="col">título</th>
          <th scope="col">descripción</th>
          <th scope="col">fecha_inicio</th>
          <th scope="col">Botones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="this.cargando">
          <th scope="row">1</th>
          <td colspan="6">
            <h3>Cargando...</h3>
          </td>

        </tr>
        <tr v-else v-for="(pro, i) in proyectos" :key="pro.id">
          <td v-text="(i + 1)"></td>
          <td v-text="(pro.título)"></td>
          <td v-text="(pro.descripción)"></td>
          <td v-text="new Date(pro.created_at).toLocaleDateString()"></td>
          <td>
              <router-link :to="{ path:'verproyecto/'+ pro.id, query: { parametro1: this.$route.query.id_user, parametro2: $route.query.email }}" class="btn btn-info">
                <i class="fa-solid fa-eye"></i>
              </router-link>
              &nbsp;
              <router-link :to="{ path:'editarproyecto/'+ pro.id}" class="btn btn-warning">
                <i class="fa-solid fa-edit"></i>
              </router-link>
              &nbsp;
              <button class="btn btn-danger" v-on:click="$event=> eliminar(pro.id,pro.nombre)">
                <i class="fa-solid fa-trash"></i>
              </button>
          </td>
       

        </tr>
      </tbody>
      <a class="navbar-brand" href="#">{{ $route.query.id }}</a>
    </table>

  </div>
</template>

<script>
import axios from 'axios';
import {confirmar} from '../funciones'
export default {
  data() {
    return {
      proyectos: null,
      cargando: false
      
    }
  },
  mounted() {
    this.getproyectos();
   
   
  },
  methods: {
    getproyectos() {
      this.cargando = true;
      const idUser = this.$route.query.id_user; // Obtener el valor de id_user desde $route.query
      console.log(idUser)
      axios.get('http://127.0.0.1:8000/api/v1/obtenerProyectosUsuario/'+idUser)
    .then(response => {
      this.proyectos = response.data;
      console.log(response.data)
      this.cargando = false;
    })
    .catch(error => {
      console.error('Error en la solicitud GET:', error);
      this.cargando = false;
    });

    },
    eliminar(id,nombre){
      confirmar('http://127.0.0.1:8000/api/v1/proyecto/',id,'eliminar proyceto','realmente desea elminar a ' + nombre+'?')
      this.cargando=false;
    
    },
  

  }
}
</script>
