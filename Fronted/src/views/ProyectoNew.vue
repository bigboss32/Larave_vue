<template>
  <div style="margin-top: 90px" class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div style="margin-top: 90px" class="card">
        <div class="card-header bg-dark text-white text-center">
          Registrar proyecto
          <p>Parámetro 1: {{ $route.query.parametro1 }}</p>
        </div>
        <div class="card-body">
          <form v-on:submit="guardar">
            <div class="d-grid col-6 mx-auto mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-user"></i>
                <input
                  type="text"
                  v-model="título"
                  id="titulo"
                  placeholder="Ingrese el título"
                  required
                  maxlength="50"
                  class="form-control"
                />
              </span>
            </div>
            <div class="d-grid col-6 mx-auto mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-user"></i>
                <input
                  type="text"
                  v-model="descripción"
                  id="descripción"
                  placeholder="Ingrese descripción"
                  required
                  maxlength="50"
                  class="form-control"
                />
              </span>
            </div>
            <div>
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-user"></i>
                  <select v-model="rol" class="form-select">
                    <option value="Admnistrador">Admnistrador</option>
                    <option value="Miembro">Miembro</option>
                    <option value="Visualizar">Visualizar</option>
                  </select>
                </span>
              </div>
            </div>
            <div>
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="date"
                    v-model="fecha_inicio"
                    id="fecha_inicio"
                    class="form-control"
                  />
                </span>
              </div>
            </div>
            <div>
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="date"
                    v-model="fecha_final"
                    id="fecha_final"
                    class="form-control"
                  />
                </span>
              </div>
            </div>
            <div class="d-grid col-6 mx-auto mb-3">
              <button class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mostraralerta, enviarsolicitud } from "../funciones";

export default {
  data() {
    return {
      título: "",
      descripción: "",
      url: "http://127.0.0.1:8000/api/v1/proyecto",
      cargando: false,
      rol: "Administrador",
      fecha_inicio:'',
      fecha_final:'',
     
    };
  },
  

  methods: {
    guardar() {
      event.preventDefault();

      this.cargando = true;
      if (this.título.trim() === "") {
        mostraralerta("Ingrese un nombre", "warning", "nombre");
      } else if (this.descripción.trim() === "") {
        mostraralerta("Ingrese descripción", "warning", "nombre");
      } else {
        var parametros = {
          título: this.título.trim(),
          descripción: this.descripción.trim(),
          id_user:this.$route.query.parametro1,
          rol:this.rol,
          fecha_inicio:this.fecha_inicio,
          fecha_final:this.fecha_final
        };
        console.log(this.$route.query.parametro1)
        enviarsolicitud("POST", parametros, this.url, "Proyecto creado");
      }
    },
  },
};
</script>

