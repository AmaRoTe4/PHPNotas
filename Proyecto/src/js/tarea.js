(function () {
  const btnAgregarTarea = document.querySelector("#btnAgregarTarea");
  const id_proyecto = document.querySelector("#id_general");
  
  btnAgregarTarea.addEventListener("click", (e) => {
    e.preventDefault();
    FormTarea();
  });

  const FormTarea = () => {
    const form = document.createElement("div");
    const fondo = document.createElement("div");
    form.classList.add("formulario-flotante");
    fondo.classList.add("fondo-oscuro");

    form.innerHTML = `
          <h4>Ingrese la tarea a realizar: </h4>
          <form action="/sesion/proyectos/listado?id=${id_proyecto.value ?? 0}" method='POST'>
              <input type="text" name="tarea" placeholder="Tarea">
              <input id="btnSubirTarea" type="submit" value="Enviar" />
              <input id="btnCancelar" type="button" value="Cancer" />
          </form>
      `;

    form.addEventListener("click", (e) => {
      if (e.target.id === "btnCancelar") {
        document.querySelector("body").removeChild(fondo);
        document.querySelector("body").removeChild(form);
      }
    });

    document.querySelector("body").appendChild(fondo);
    document.querySelector("body").appendChild(form);
  };
})();
