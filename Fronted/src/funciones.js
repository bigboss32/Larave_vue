import Swal from "sweetalert2";
import axios from "axios";
import router from './router';

export function mostraralerta(titulo, icono, foco = '') {
  if (foco !== '') {
    const elementoFoco = document.getElementById(foco);
    if (elementoFoco) {
      elementoFoco.focus();
    }
  }
  Swal.fire({
    title: titulo,
    icon: 'info',
    customClass: {
      confirmButton: 'btn btn-primary',
      popup: 'animated zoomIn',
    },
    buttonsStyling: false
  });
}

export function confirmar(urla, id, titulo, mensaje) {
  var url = urla + id;
  const button = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success me-3',
      cancelButton: 'btn btn-danger',
    },
  });

  button.fire({
    title: titulo,
    text: mensaje,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '<i class="fa-solid fa-check"></i> si, eliminar',
    cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar'
  }).then((res) => {
    if (res.isConfirmed) {
      enviarsolicitudborrartarea('DELETE', { id: id }, url, 'Eliminado con éxito');
    } else {
      mostraralerta('Operación cancelada', 'info');
    }
  });


}
export function agregartareaaproyceto(parametros) {
  axios.post("http://127.0.0.1:8000/api/v1/crearTarea", parametros)
    .then(function (response) {
      // Manejar la respuesta exitosa aquí
      console.log(response.data);
      window.location.reload();
    })
    .catch(function (error) {
      // Manejar el error aquí
      console.log(error);
    });

}

export function agregarusuarioaproyceto(parametros) {
  axios.post("http://127.0.0.1:8000/api/v1/asignarProyecto", parametros)
    .then(function (response) {
      // Manejar la respuesta exitosa aquí
      console.log(response.data);
      window.location.reload();
    })
    .catch(function (error) {
      // Manejar el error aquí
      console.log(error);
    });

}

export function enviarsolicitudeditar(metodo, parametros, url, mensaje) {
  axios({
    method: metodo, url, data: parametros,
  })
    .then(function (res) {
      var estado = res.status;



      if (estado === 200 || estado === 201) {
        mostraralerta(mensaje, 'success');

      } else {
        mostraralerta('No se realizó', 'error');
      }
    })
    .catch(function (error) {
      mostraralerta('Servidor no disponible' + error);
    });
}

export function enviarsolicitudborrartarea(metodo, parametros, url, mensaje) {
  axios({
    method: metodo, url, data: parametros,
  })
    .then(function (res) {
      var estado = res.status

      if (estado === 200 || estado === 201) {
        mostraralerta(mensaje, 'success');
        window.location.reload();
      } else {
        mostraralerta('No se realizó', 'error');
      }
    })
    .catch(function (error) {
      mostraralerta('Servidor no disponible' + error);
    });
}

export function enviarsolicitud(metodo, parametros, url, mensaje) {
  axios({
    method: metodo, url, data: parametros,
  })
    .then(function (res) {
      var estado = res.status;
      var proyectoId = "" + res.data.id;

      var parametrosacosiar = {
        user_id: parametros.id_user,
        proyecto_id: proyectoId,
        rol: parametros.rol
      };
      console.log(parametrosacosiar)
      axios.post("http://127.0.0.1:8000/api/v1/asignarProyecto", parametrosacosiar)
        .then(function (response) {
          // Manejar la respuesta exitosa aquí
          console.log(response.data);
        })
        .catch(function (error) {
          // Manejar el error aquí
          console.log(error);
        });

      if (estado === 200 || estado === 201) {
        mostraralerta(mensaje, 'success');

      } else {
        mostraralerta('No se realizó', 'error');
      }
    })
    .catch(function (error) {
      mostraralerta('Servidor no disponible' + error);
    });
}

function asociarcreadorconproyecto(parametrosacosiar) {
  var datos = {
    user_id: parametrosacosiar.user_id,
    proyecto_id: parametrosacosiar.proyecto_id,
    rol: parametrosacosiar.rol
  };
  console.log(datos)


}

export function registarusu(metodo, parametros, url, mensaje) {


  axios({ method: metodo, url, data: parametros })
    .then(function (res) {
      var estado = res.status;
      console.log(estado)
      if (estado === 200 || estado === 201) {
        mostraralerta(mensaje, 'success');
        window.setTimeout(function () {
          window.location.href = '/';
        }, 1000);
      } else {
        mostraralerta('No se realizó', 'error');
      }
    })
    .catch(function (error) {
      mostraralerta('Servidor no disponible' + error);
    });
}



export function sesion(parametros, url, mensaje) {

  return axios.post(url, parametros)
    .then(response => {
      if (response.data && response.data.accessToken) {
        const token = response.data.accessToken;
        localStorage.setItem('token', token); // Guarda el token en localStorage
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        console.log(token);
        mostraralerta(mensaje, 'success');

        router.push({
          path: '/home',
          query: {
            token,
            username: response.data.user.name,
            email: response.data.user.email,
            id_user: response.data.user.id
          }
        });
      } else {
        // La respuesta es negativa, no haces nada
      }

    })
    .catch(error => {
      mostraralerta('Error en el inicio de sesión', 'error');

    });
}


export function logout(url) {

  return axios.get(url)
    .then(response => {


      router.push({ path: '/' });

    })
    .catch(error => {
      mostraralerta('Error en el inicio de sesión', 'error');
      throw error; // Lanza el error para que pueda ser manejado en el componente Vue
    });
}

export function elminarusariodeunrpoyceto(id_user, id_proyecto) {
 axios.delete("http://127.0.0.1:8000/api/v1/elminarusariodeunrpoyceto/"+id_user+"/"+id_proyecto)
    .then(function (response) {
      // Manejar la respuesta exitosa aquí
      console.log(response.data);
      window.location.reload();
    })
    .catch(function (error) {
      // Manejar el error aquí
      console.log(error);
    });

}

export  function verificartoken(){
  axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  });
}


