const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";

    }
});

//aparicion de las ventanas para el menu

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("empleados1").addEventListener("click", function () {
        mostrarSeccion("empleados");
    });
    document.getElementById("inventario1").addEventListener("click", function () {
        mostrarSeccion("inventario");
    });
    document.getElementById("productos1").addEventListener("click", function () {
        mostrarSeccion("productos");
    });
    document.getElementById("ventas1").addEventListener("click", function () {
        mostrarSeccion("ventas");
    });
    document.getElementById("clientes1").addEventListener("click", function () {
        mostrarSeccion("clientes");
    });
    document.getElementById("proveedores1").addEventListener("click", function () {
        mostrarSeccion("proveedores");
    });
    window.addEventListener("resize", anchopagina);

    function mostrarSeccion(seccionId) {
        var secciones = document.querySelectorAll(".opciones > div");
        secciones.forEach(function (seccion) {
            if (seccion.id === seccionId) {
                seccion.classList.remove("d-none");
            } else {
                seccion.classList.add("d-none");
            }
        });
    }

    function anchopagina() {
        var ocultos = document.querySelectorAll(".opciones > div.d-none");
        if (window.innerWidth > 850) {
            ocultos.forEach(function (oculto) {
                oculto.style.display = "block";
            });
        } else {
            ocultos.forEach(function (oculto) {
                oculto.style.display = "none";
            });
        }
    }
});
