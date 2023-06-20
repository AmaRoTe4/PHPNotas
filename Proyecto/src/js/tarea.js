(function () {
  let tareas = [];
  let errores = [];
  let datosUser;

  const id_proyecto = document.querySelector("#id_general").value;
  const $btnAgregarTarea = document.querySelector("#btnAgregarTarea");
  const $lista_tareas = document.querySelector("#lista-tareas");
  const $fondo = document.createElement("div");
  $fondo.classList.add("fondo-oscuro");

  const FormTarea = (id = 0) => {
    let tarea;
    if (id !== 0) tarea = obtenerTarea(id);

    const boxForm = document.createElement("div");
    const form = document.createElement("form");
    const h4 = document.createElement("h4");
    const inputText = document.createElement("input");
    const inputEnv = document.createElement("input");
    const inputCancelar = document.createElement("input");

    boxForm.classList.add("formulario-flotante");

    inputText.type = "text";
    inputText.name = "nombre";
    inputText.placeholder = "Nombre";
    inputText.value = id === 0 ? "" : tarea.tarea;

    inputEnv.type = "button";
    inputEnv.id = "btnEnv";
    inputEnv.value = id === 0 ? "Crear" : "Editar";

    inputCancelar.type = "button";
    inputCancelar.id = "btnCancelar";
    inputCancelar.value = "Cancelar";

    h4.textContent =
      id === 0
        ? "Ingrese el nombre del tarea: "
        : "Mofidique la tarea como quiera: ";

    form.appendChild(inputText);
    form.appendChild(inputEnv);
    form.appendChild(inputCancelar);

    boxForm.appendChild(h4);
    boxForm.appendChild(form);

    form.addEventListener("click", async (e) => {
      if (e.target.id === "btnCancelar") {
        document.querySelector("body").removeChild($fondo);
        document.querySelector("body").removeChild(boxForm);
        return;
      }
      if (e.target.id !== "btnEnv") return;

      let resultado = false;

      if (id === 0) {
        resultado = await CrearTarea(inputText.value, 1);
      } else {
        resultado = await EditarTarea(
          inputText.value,
          tarea.estado === 1 ? 0 : 1,
          id
        );
      }

      if (resultado) {
        document.querySelector("body").removeChild($fondo);
        document.querySelector("body").removeChild(boxForm);

        alert(id === 0 ? "Creado con exito" : "Editado con exito");

        if (id === 0) await CargarTareas();
        ListarTareas();
      } else {
        alert("Algo salio mal al " + id === 0 ? "Crear" : "Editar");
        //ListarErrores();
      }
    });

    document.querySelector("body").appendChild($fondo);
    document.querySelector("body").appendChild(boxForm);
  };

  const CargarTareas = async () => {
    await fetch(`http://localhost:3000/api/tareas/data?proyecto=${id_proyecto}`)
      .then((response) => response.json())
      .then((data) => {
        tareas = [];
        if (data === null) return;
        data.map((n) => tareas.push(n));
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const ObtenerUsuario = async () => {
    await fetch("http://localhost:3000/api/data")
      .then((response) => response.json())
      .then((data) => {
        datosUser = data;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const ValidarSesion = () => {
    if (!datosUser.login)
      window.location.href = "http://localhost:3000/login?action=101";
  };

  const ListarTareas = () => {
    while ($lista_tareas.firstChild) {
      $lista_tareas.removeChild($lista_tareas.firstChild);
    }

    if (tareas.length === 0) return;

    tareas.map((tarea) => {
      const $li = document.createElement("li");

      $li.innerHTML = `
      <p>
        ${tarea.tarea}
      </p>
      <form>
          <input type="hidden" name="id" value="${tarea.id}">
          ${
            Number(tarea.estado) === 0
              ? "<input type='button' id='btnEstado' class='noHecha' value='no hecha'/>"
              : "<input type='button' id='btnEstado' class='hecha' value='hecha'/>"
          }
      </form>
      <form>
          <input type="hidden" name="id" value="${tarea.id}">
          <input type='button' id='btnEliminar' class="eliminar" value="eliminar" />
      </form>
      
      `;
      $lista_tareas.appendChild($li);

      $li.addEventListener("click", async (e) => {
        e.preventDefault();

        let respuesta = false;

        if (e.target.id === "btnEstado") {
          respuesta = await EditarTarea(tarea.tarea, tarea.estado, tarea.id);
        } else if (e.target.id === "btnEliminar") {
          respuesta = await EliminarTarea(tarea.id);
        }

        if (respuesta) {
          //await CargarTareas();
          ListarTareas();
        }
        //errrores
      });

      $li.addEventListener("dblclick", (e) => {
        FormTarea(tarea.id);
      });
    });
  };

  const CrearTarea = async (data) => {
    const formulario = new FormData();
    formulario.append("tarea", data);
    formulario.append("id_proyecto", id_proyecto);

    const response = await fetch("http://localhost:3000/api/tareas/create", {
      method: "POST",
      body: formulario,
    }).catch((error) => {
      console.error("Error:", error);
    });

    return response.status === 200;
  };

  const EditarTarea = async (data, estado, id) => {
    const formulario = new FormData();
    formulario.append("id", id);
    formulario.append("id_proyecto", id_proyecto);
    formulario.append("tarea", data);
    formulario.append("estado", Number(estado) === 0 ? 1 : 0);

    const response = await fetch("http://localhost:3000/api/tareas/update", {
      method: "POST",
      body: formulario,
    }).catch((error) => {
      console.error("Error:", error);
    });

    if (response.status === 200) {
      tareas = tareas.map((n) => {
        if (n.id === id) {
          n.estado = Number(n.estado) === 0 ? 1 : 0;
          n.tarea = data;
        }

        return n;
      });

      return true;
    }

    return false;
  };

  const EliminarTarea = async (id) => {
    const formulario = new FormData();
    formulario.append("id", id);

    const response = await fetch("http://localhost:3000/api/tareas/delete", {
      method: "POST",
      body: formulario,
    }).catch((error) => {
      console.error("Error:", error);
    });

    if (response.status === 200) {
      tareas = tareas.filter((n) => n.id !== id);
      return true;
    }

    return false;
  };

  const obtenerTarea = (id) => {
    return tareas.find((n) => n.id === id);
  };

  $btnAgregarTarea.addEventListener("click", (e) => {
    e.preventDefault();
    FormTarea();
  });

  document.addEventListener("DOMContentLoaded", async function () {
    await ObtenerUsuario();
    ValidarSesion();
    await CargarTareas();
    ListarTareas();
    //ListarErrores();
  });
})();
