<template>
  <div
    class="card-body d-flex align-items-center justify-content-center"
    style="margin-top: 90px"
  >
    <div class="card bg-light" style="max-width: 100rem">
      <div class="card-header">Lista de proyectos</div>
      <div class="card-body">
        <input
          type="text"
          v-model="filtro"
          placeholder="Buscar proyecto"
          class="form-control mb-3"
        />
        <table class="table" style="margin-top: 20px">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Título</th>
              <th scope="col">Descripción</th>
              <th scope="col">Fecha de inicio</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="cargando">
              <td colspan="5">
                <h3>Cargando...</h3>
              </td>
            </tr>
            <tr
              v-else
              v-for="(proyecto, index) in proyectosFiltrados"
              :key="proyecto.id"
            >
              <td>{{ index + 1 }}</td>
              <td>{{ proyecto.título }}</td>
              <td>{{ proyecto.descripción }}</td>
              <td>{{ new Date(proyecto.created_at).toLocaleDateString() }}</td>
              <td>
                <router-link
                  :to="{
                    path: 'verproyecto/' + proyecto.id,
                    query: {
                      parametro1: $route.query.id_user,
                      parametro2: $route.query.email,
                    },
                  }"
                  class="btn btn-info"
                >
                  <i class="fa-solid fa-eye"></i>
                </router-link>
                &nbsp;
                <router-link
  :to="{ path: 'editarproyecto/' + proyecto.id }"
  class="btn btn-warning"
  :class="{ 'disabled-link': proyecto.rol !== 'Admnistrador' }"
  :style="{ 'pointer-events': proyecto.rol !== 'Admnistrador' ? 'none' : 'auto' }"
>
  <i class="fa-solid fa-edit"></i>
</router-link>
                &nbsp;
                <button
  class="btn btn-danger"
  @click="eliminar(proyecto.id, proyecto.nombre)"
  :disabled="proyecto.rol !== 'Admnistrador'"
>
  <i class="fa-solid fa-trash"></i>
</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <a class="navbar-brand" href="#">{{ $route.query.id }}</a>
  </div>
</template>

<script>
import axios from "axios";
import { confirmar } from "../funciones";

export default {
  data() {
    return {
      proyectos: null,
      cargando: false,
      filtro: "",
      rol: "",
    };
  },
  mounted() {
    this.getproyectos();
  },
  computed: {
    proyectosFiltrados() {
      if (!this.filtro) {
        return this.proyectos;
      }
      const filtroLower = this.filtro.toLowerCase();
      return this.proyectos.filter((proyecto) => {
        return (
          proyecto.título.toLowerCase().includes(filtroLower) ||
          proyecto.descripción.toLowerCase().includes(filtroLower)
        );
      });
    },
  },
  methods: {
    getproyectos() {
      this.cargando = true;
      const idUser = this.$route.query.id_user; // Obtener el valor de id_user desde $route.query
      axios
        .get("http://127.0.0.1:8000/api/v1/obtenerProyectosUsuario/" + idUser)
        .then((response) => {
          const proyectos = response.data.map((proyecto) => {
            proyecto.rol = proyecto.pivot.rol;
            return proyecto;
          });
          this.proyectos = proyectos;
          console.log(proyectos[0].rol);
          this.cargando = false;
        })
        .catch((error) => {
          console.error("Error en la solicitud GET:", error);
          this.cargando = false;
        });
    },
    eliminar(id, nombre) {
      confirmar(
        "http://127.0.0.1:8000/api/v1/proyecto/",
        id,
        "eliminar proyceto",
        "realmente desea elminar a " + nombre + "?"
      );
      this.cargando = false;
    },
  },
};
</script>

<style>
body {
  background-color: #f2f2f2; /* Cambia este valor al color gris que desees */
}
</style>