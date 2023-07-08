<template>
  <div style="margin-top: 90px" class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div style="margin-top: 90px" class="card">
        <div class="card-header bg-dark text-white text-center">
          Editar proyecto
        </div>
        <div class="card-body">
          <form v-on:submit="actualizar">
            <div class="d-grid col-6 mx-auto mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-user"></i>
                <input type="text" v-model="título" id="titulo" placeholder="Ingrese el título" required maxlength="50" class="form-control">
              </span>
            </div>
            <div class="d-grid col-6 mx-auto mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-user"></i>
                <input type="text" v-model="descripción" id="descripción" placeholder="Ingrese descripción" required maxlength="50" class="form-control">
              </span>
            </div>
            <div class="d-grid col-6 mx-auto mb-3">
              <button class="btn btn-warning">
                <i class="fa-solid fa-refresh"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { mostraralerta, enviarsolicitud,enviarsolicitudeditar } from '../funciones';
import {useRoute} from 'vue-router';

export default {
  data() {
    return {
      id:0,
      título:'',
      descripción:'',
      url:'http://127.0.0.1:8000/api/v1/proyecto',
      cargando: false
    }
  },
  mounted(){
    const ruta= useRoute();
    this.id=ruta.params.id;
    this.url+='/'+this.id;
    this.encontrarproyceto();
  },

  methods: {
    encontrarproyceto(){
      axios.get(this.url).then(
        res=>{
          this.título=res.data.data.título
          this.descripción=res.data.data.descripción
        }
      );
    },
    actualizar() {
      event.preventDefault();
      
      this.cargando = true;
      if (this.título.trim() === '') {
        mostraralerta('Ingrese un nombre', 'warning', 'nombre');
      } else if (this.descripción.trim() === '') {
        mostraralerta('Ingrese descripción', 'warning', 'nombre');
      } else {
        var parametros = {
          título: this.título.trim(),
          descripción: this.descripción.trim()
        }
        enviarsolicitudeditar('PUT', parametros, this.url, 'Proyecto actualizado');
      }
    }
  }
}
</script>

