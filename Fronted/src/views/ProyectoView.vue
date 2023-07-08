<template>
  <div style="margin-top: 90px" class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div style="margin-top: 90px" class="card">
        <div class="card-header bg-dark text-white text-center">
          Proyecto a detalle
        </div>
        <div class="card-body">
          <form v-on:submit="actualizar">
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

            <div class="d-grid col-6 mx-auto mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-calendar"></i>
                <input
                  type="text"
                  v-model="fecha_inicio"
                  id="fecha_inicio"
                  placeholder="Ingrese descripción"
                  required
                  maxlength="50"
                  class="form-control"
                />
              </span>
            </div>

            <div class="d-grid col-6 mx-auto mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-calendar"></i>
                <input
                  type="text"
                  v-model="fecha_final"
                  id="fecha_final"
                  placeholder="Ingrese descripción"
                  required
                  maxlength="50"
                  class="form-control"
                />
              </span>
            </div>
          </form>
          <div class="d-flex justify-content-center">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha de creación</th>
                  <th>btones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="usuario in usuarios" :key="usuario.id">
                  <td>{{ usuario.id }}</td>
                  <td>{{ usuario.name }}</td>
                  <td>{{ usuario.email }}</td>
                  <td>{{ usuario.created_at }}</td>
                  <td>
                    <button
                      class="btn btn-danger"
                      v-on:click="($event) => eliminar(pro.id, pro.nombre)"
                    >
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div>
            <button @click="abrirVentanaEmergenteuser">agregar usarios</button>

            <div
              v-if="mostrarVentanaEmergenteusuario"
              class="ventana-emergente"
            >
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="text"
                    v-model="usuario_agregar"
                    id="descripción_tarea"
                    placeholder="Ingrese descripción"
                    required
                    maxlength="50"
                    class="form-control"
                  />
                </span>
              </div>
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

              <div class="botones">
                <button
                  @click="cerrarVentanaEmergenteuser"
                  class="btn-cancelar"
                >
                  <i class="fa-solid fa-times"></i> Cancelar
                </button>
                <button @click="asignarusuarios" class="btn-agregar">
                  <i class="fa-solid fa-plus"></i> Agregar
                </button>
              </div>
            </div>
          </div>
          <div style="margin-top: 30px">
            <div class="card-header bg-dark text-white text-center">
              Proyecto Tareas
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Proyecto ID</th>
                  <th>Fecha de creación</th>
                  <th>botones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in tareas" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.título }}</td>
                  <td>{{ item.descripción }}</td>
                  <td>{{ item.proyecto_id }}</td>
                  <td>{{ item.created_at }}</td>
                  <td>
                    &nbsp;
                    <router-link
                      :to="{ path: 'editarproyecto/' }"
                      class="btn btn-warning"
                    >
                      <i class="fa-solid fa-edit"></i>
                    </router-link>
                    &nbsp;
                    <button
                      class="btn btn-danger"
                      v-on:click="($event) => eliminartarea( item.id, item.título)"
                    >
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div v-if="!tareas.length" class="text-center mt-3">
              No hay tareas asociadas
            </div>
          </div>
          <div>
            <button @click="abrirVentanaEmergente">Agregar tareas</button>

            <div v-if="mostrarVentanaEmergente" class="ventana-emergente">
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="text"
                    v-model="título_tarea"
                    id="título_tarea"
                    placeholder="Ingrese descripción"
                    required
                    maxlength="50"
                    class="form-control"
                  />
                </span>
              </div>
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="text"
                    v-model="descripción_tarea"
                    id="descripción_tarea"
                    placeholder="Ingrese descripción"
                    required
                    maxlength="50"
                    class="form-control"
                  />
                </span>
              </div>

              <div class="botones">
                <button @click="cerrarVentanaEmergente" class="btn-cancelar">
                  <i class="fa-solid fa-times"></i> Cancelar
                </button>
                <button @click="agregarTarea" class="btn-agregar">
                  <i class="fa-solid fa-plus"></i> Agregar
                </button>
              </div>
            </div>
            <div v-if="mostrarVentanaEmergente" class="ventana-emergente">
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="text"
                    v-model="título_tarea"
                    id="título_tarea"
                    placeholder="Ingrese descripción"
                    required
                    maxlength="50"
                    class="form-control"
                  />
                </span>
              </div>
              <div class="d-grid col-6 mx-auto mb-3">
                <span class="input-group-text">
                  <i class="fa-solid fa-calendar"></i>
                  <input
                    type="text"
                    v-model="descripción_tarea"
                    id="descripción_tarea"
                    placeholder="Ingrese descripción"
                    required
                    maxlength="50"
                    class="form-control"
                  />
                </span>
              </div>

              <div class="botones">
                <button @click="cerrarVentanaEmergente" class="btn-cancelar">
                  <i class="fa-solid fa-times"></i> Cancelar
                </button>
                <button @click="agregarTarea" class="btn-agregar">
                  <i class="fa-solid fa-plus"></i> Agregar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.botones {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.btn-cancelar {
  background-color: #dc3545;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  cursor: pointer;
}

.btn-agregar {
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  cursor: pointer;
}
table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}
.ventana-emergente {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 400px;
  height: 450px;
  background-color: #f2f3eb;
  border: 1px solid #ccc;
  padding: 20px;
}
</style>
<script>
import axios from "axios";
import {
  mostraralerta,
  enviarsolicitud,
  agregartareaaproyceto,
  agregarusuarioaproyceto,
  confirmar
} from "../funciones";
import { useRoute } from "vue-router";

export default {
  data() {
    return {
      id: 0,
      título: "",
      descripción: "",
      fecha_inicio: "",
      fecha_final: "",
      url: "http://127.0.0.1:8000/api/v1/proyecto",
      cargando: false,
      usuarios: [],
      tareas: [],
      mostrarVentanaEmergente: false,
      mostrarVentanaEmergenteusuario: false,
    };
  },
  mounted() {
    const ruta = useRoute();
    this.id = ruta.params.id;
    this.url += "/" + this.id;
    this.encontrarproycetousuarios();
    this.encontrarproyceto();
    this.tareasproycetos();
  },

  methods: {
    agregarTarea() {
      console.log("asa");
      var parametros = {
        proyecto_id: this.id,
        título: this.título_tarea.trim(),
        descripción: this.descripción_tarea.trim(),
      };

      agregartareaaproyceto(parametros);

      this.mostrarVentanaEmergente = false;
    },
    encontrarproyceto() {
      axios.get(this.url).then((res) => {
        this.título = res.data.data.título;
        this.descripción = res.data.data.descripción;
        this.fecha_inicio = res.data.data.fecha_inicio;
        this.fecha_final = res.data.data.fecha_final;
      });
    },
    encontrarproycetousuarios() {
      axios
        .get("http://localhost:8000/api/v1/obtenerUsuariosProyecto/" + this.id)
        .then((res) => {
          if (res.data) {
            this.usuarios = res.data;
          }
        });
    },

    tareasproycetos() {
      console.log(this.id);
      axios
        .get("http://localhost:8000/api/v1/obtenerTareas/" + this.id)
        .then((res) => {
          console.log(res.data);
          if (res.data && res.data.length > 0) {
            this.tareas = res.data;
          }
        });
    },
    volver() {
      this.$router.go(-1); // Navegar a la página anterior
      this.$route.query.id_user;
    },
    abrirVentanaEmergente() {
      this.mostrarVentanaEmergente = true;
    },
    cerrarVentanaEmergente() {
      this.mostrarVentanaEmergente = false;
    },
    abrirVentanaEmergenteuser() {
      this.mostrarVentanaEmergenteusuario = true;
    },
    cerrarVentanaEmergenteuser() {
      this.mostrarVentanaEmergenteusuario = false;
    },
    asignarusuarios() {
      console.log("asa");
      var parametros = {
        user_id: this.usuario_agregar.trim(),
        proyecto_id: this.id,
        rol: this.rol.trim(),
      };
      console.log(parametros);
      agregarusuarioaproyceto(parametros);
    },
    eliminartarea(id, nombre) {
      confirmar(
        "http://127.0.0.1:8000/api/v1/eliminartarea/",
        id,
        "eliminar proyceto",
        "realmente desea elminar a " + nombre + "?"
      );
      this.cargando = false;
    },
  },
};
</script>

