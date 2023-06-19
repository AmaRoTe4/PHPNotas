(function () {
  let proyectos = [];
  let errores = [];
  let datosUser;

  const $btnAgregarProyecto = document.querySelector("#btnAgregarProyecto");
  const $listaProyectos = document.querySelector("#lista_proyectos");
  const $tituloProyecto = document.querySelector("#titulo_proyecto");

  const fondo = document.createElement("div");
  fondo.classList.add("fondo-oscuro");

  const FormProyectos = (id = 0) => {
    let data;
    if(id !== 0) data = getProyecto(id);

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
    inputText.value = id === 0 ? "" : data.nombre;

    inputEnv.type = "button";
    inputEnv.id = "btnEnv";
    inputEnv.value = id === 0 ? "Crear" : "Editar";

    inputCancelar.type = "button";
    inputCancelar.id = "btnCancelar";
    inputCancelar.value = "Cancelar";

    h4.textContent =
      id === 0
        ? "Ingrese el nombre del proyecto: "
        : "Mofidique el nombre como quiera: ";

    form.appendChild(inputText);
    form.appendChild(inputEnv);
    form.appendChild(inputCancelar);

    boxForm.appendChild(h4);
    boxForm.appendChild(form);

    form.addEventListener("click", async (e) => {
      e.preventDefault();
      if (e.target.id === "btnCancelar") {
        document.querySelector("body").removeChild(fondo);
        document.querySelector("body").removeChild(boxForm);
        return;
      } else if (e.target.id === "btnEnv") {
        let respuesta = false; 
        respuesta = id === 0 
          ? await crearProyecto(form.elements["nombre"].value)
          : await editarProyecto(form.elements["nombre"].value, id)

        if (respuesta) {
          document.querySelector("body").removeChild(fondo);
          document.querySelector("body").removeChild(boxForm);

          alert(id === 0 ? "Creado con exito" : "Editado con exito");
          await CargarProyectos();
          ListarProyectos();
        } else {
          alert("Algo salio mal al " + id === 0 ? "Crear" : "Editar");
          ListarErrores();
        }
      }
    });

    document.querySelector("body").appendChild(fondo);
    document.querySelector("body").appendChild(boxForm);
  };

  const FormAction = (id = 0) => {
    if (id === 0) return;

    const boxForm = document.createElement("div");
    const form = document.createElement("form");
    const h4 = document.createElement("h4");
    boxForm.classList.add("formulario-flotante");

    h4.textContent = "Que Accion desea hacer con esta tarea?";
    form.innerHTML = `
      <input id="btnEditar" type="button" value="Editar" />
      <input id="btnEliminar" type="button" value="Borrar" />
    `;
    boxForm.appendChild(h4);
    boxForm.appendChild(form);

    form.addEventListener("click", async (e) => {
      e.preventDefault();
      if (e.target.id === "btnEditar") {
        FormProyectos(id);
      } else if (e.target.id === "btnEliminar") {
        const respuesta = eliminarProyecto(id);
        document.querySelector("body").removeChild(fondo);

        if (respuesta) {
          alert("Eliminado con exito");
          await CargarProyectos();
          ListarProyectos();
        } else alert("Error al borrar");
      }

      document.querySelector("body").removeChild(boxForm);
      return;
    });

    document.querySelector("body").appendChild(fondo);
    document.querySelector("body").appendChild(boxForm);
  };

  const CargarProyectos = async () => {
    await fetch("http://localhost:3000/api/proyectos/data")
      .then((response) => response.json())
      .then((data) => {
        proyectos = [];
        data.map((n) => proyectos.push(n));
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  };

  const ListarProyectos = () => {
    if (proyectos.length === 0) return;

    while ($listaProyectos.firstChild) {
      $listaProyectos.removeChild($listaProyectos.firstChild);
    }

    proyectos.map((proyecto) => {
      const $li = document.createElement("li");
      const $a = document.createElement("a");

      $a.href = `/sesion/proyectos/listado?id=${proyecto.id}`;
      $a.textContent = proyecto.nombre;
      $a.id = proyecto.id + "";

      $li.appendChild($a);

      $listaProyectos.appendChild($li);

      $li.addEventListener("contextmenu", (e) => {
        e.preventDefault();
        FormAction(e.target.id);
      });
    });
  };

  //ver
  const ListarErrores = () => {
    if (errores.length === 0) return;

    const div = document.createElement("DIV");

    errores.map((error) => {
      const h4 = document.createElement("H4");
      h4.classList.add("colorRed");
      h4.textContent = error;

      div.appendChild(h4);
    });

    $tituloProyecto.insertAdjacentElement("afterend", div);

    //while ($listaProyectos.firstChild) {
    //  $listaProyectos.removeChild($listaProyectos.firstChild);
    //}

    //proyectos.map(proyecto => {

    //  const li = document.createElement('li');

    //  const a = document.createElement("a")
    //  a.href = `/sesion/proyectos/listado?id=${proyecto.id}`
    //  a.textContent = proyecto.nombre

    //  li.appendChild(a);

    //  $listaProyectos.appendChild(li)
    //})
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

  const eliminarProyecto = async (id) => {
    const formulario = new FormData();
    formulario.append("id", id);

    const response = await fetch("http://localhost:3000/api/proyectos/delete", {
      method: "POST",
      body: formulario,
    }).catch((error) => {
      console.error("Error:", error);
    });

    return response.status === 200;
  };

  const getProyecto = (id) => {
    return proyectos.find(n => n.id === id)
  };

  const crearProyecto = async (data) => {
    const formulario = new FormData();
    formulario.append("nombre", data);

    const response = await fetch("http://localhost:3000/api/proyectos/create", {
      method: "POST",
      body: formulario,
    }).catch((error) => {
      console.error("Error:", error);
    });

    return response.status === 200;
  };

  const editarProyecto = async (nombre , id) => {
    const formulario = new FormData();
    formulario.append("nombre", nombre);
    formulario.append("id", id);

    const response = await fetch("http://localhost:3000/api/proyectos/update", {
      method: "POST",
      body: formulario,
    }).catch((error) => {
      console.error("Error:", error);
    });

    return response.status === 200;
  };

  $btnAgregarProyecto.addEventListener("click", (e) => {
    FormProyectos();
  });

  document.addEventListener("DOMContentLoaded", async function () {
    await ObtenerUsuario();
    ValidarSesion();
    await CargarProyectos();
    ListarProyectos();
    ListarErrores();
  });

})();
