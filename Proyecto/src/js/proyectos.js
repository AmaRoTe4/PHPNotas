(function () {
  const btnAgregarProyecto = document.querySelector("#btnAgregarProyecto");

  btnAgregarProyecto.addEventListener("click", (e) => {
    FormProyectos();
  });

  const FormProyectos = () => {
    const form = document.createElement("div");
    const fondo = document.createElement("div");
    form.classList.add("formulario-flotante");
    fondo.classList.add("fondo-oscuro");

    form.innerHTML = `
        <h4>Ingrese el nombre del proyecto:</h4>
        <form method='POST'>
            <input type="text" name="nombre" placeholder="Nombre">
            <input id="submit" type="submit" value="Enviar" />
            <input id="btnCancelar" type="button" value="Cancer" />
        </form>
    `;

    form.addEventListener("click", (e) => {
        if(e.target.id === "btnCancelar"){
            document.querySelector("body").removeChild(fondo);
            document.querySelector("body").removeChild(form);
        }
    });

    document.querySelector("body").appendChild(fondo);
    document.querySelector("body").appendChild(form);
  };

})();
