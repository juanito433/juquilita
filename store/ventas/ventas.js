// Lógica del buscador y carrito

let carrito = []; // Variable global para el carrito
const carritoTabla = document.getElementById('carrito').querySelector('tbody');
const totalElement = document.getElementById('total');

// Cargar carrito desde LocalStorage al cargar la página
document.addEventListener('DOMContentLoaded', cargarCarritoDesdeLocalStorage);

// Buscar productos y mostrarlos dinámicamente
const searchBox = document.getElementById('searchBox');
const resultados = document.getElementById('resultados');

searchBox.addEventListener('input', function () {
    const searchText = searchBox.value.trim().toLowerCase();
    resultados.innerHTML = '';

    if (searchText.length > 0) {
        fetch(`buscar_productos.php?query=${searchText}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(producto => {
                        const div = document.createElement('div');
                        div.classList.add('resultado-item');
                        div.innerHTML = `
                            <span>
                                <strong>${producto.nombre}</strong> - $${producto.precio}/kg
                                <input type="number" id="quantity-${producto.id}" placeholder="En gramos" min="1">
                                <button onclick="addToCart(${producto.id}, '${producto.nombre}', ${producto.precio})">Añadir</button>
                            </span>`;
                        resultados.appendChild(div);
                    });
                } else {
                    resultados.innerHTML = '<p>No se encontraron productos</p>';
                }
            })
            .catch(error => console.error('Error al buscar productos:', error));
    }
});

// Agregar productos al carrito
function addToCart(id, nombre, precioPorKilo) {
    const cantidadInput = document.getElementById(`quantity-${id}`);
    const cantidadGramos = parseFloat(cantidadInput.value) || 0;

    if (cantidadGramos <= 0) {
        alert('Por favor, ingresa una cantidad válida.');
        return;
    }

    const precioTotal = (precioPorKilo / 1000) * cantidadGramos;
    const productoExistente = carrito.find(p => p.id === id);

    if (productoExistente) {
        productoExistente.cantidadGramos += cantidadGramos;
        productoExistente.precioTotal += precioTotal;
    } else {
        carrito.push({ id, nombre, cantidadGramos, precioTotal, precioPorKilo });
    }

    actualizarCarrito();
}

// Actualizar el carrito en la pantalla
function actualizarCarrito() {
    carritoTabla.innerHTML = '';
    let total = 0;

    carrito.forEach((producto, index) => {
        total += producto.precioTotal;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="data-title">${producto.id}</td>
            <td class="data-title">${producto.nombre}</td>
            
            <td>
                <input class="data-title" type="number" value="${producto.cantidadGramos}" min="1"
                    onchange="editarCantidad(${index}, this.value)">
            </td>
            <td class="data-title">$${producto.precioTotal.toFixed(2)}</td>
            <td><button class='button' onclick="eliminarProducto(${index})">Eliminar</button></td>
        `;
        carritoTabla.appendChild(row);
    });

    totalElement.textContent = total.toFixed(2);
    guardarCarritoEnLocalStorage();
}

// Editar cantidad en el carrito
function editarCantidad(index, nuevaCantidadGramos) {
    nuevaCantidadGramos = parseFloat(nuevaCantidadGramos);
    if (nuevaCantidadGramos <= 0) {
        alert('Cantidad inválida.');
        return;
    }

    const producto = carrito[index];
    producto.cantidadGramos = nuevaCantidadGramos;
    producto.precioTotal = (producto.precioPorKilo / 1000) * nuevaCantidadGramos;

    actualizarCarrito();
}

// Eliminar producto del carrito
function eliminarProducto(index) {
    carrito.splice(index, 1);
    actualizarCarrito();
}

// Confirmar venta y vaciar carrito
function confirmarVenta() {
    if (carrito.length === 0) {
        alert('El carrito está vacío. Agrega productos antes de confirmar la venta.');
        return;
    }

    fetch('procesar_venta.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(carrito)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`Venta registrada con éxito. Total: $${data.total.toFixed(2)}`);
            carrito = []; // Vaciar el carrito
            guardarCarritoEnLocalStorage();
            actualizarCarrito(); // Actualizar la interfaz
        } else {
            alert(`Error: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error al procesar la venta:', error);
        alert('Hubo un error al procesar la venta.');
    });
}



// Cargar carrito desde LocalStorage
function cargarCarritoDesdeLocalStorage() {
    const carritoGuardado = localStorage.getItem('carrito');
    if (carritoGuardado) {
        carrito = JSON.parse(carritoGuardado);
        actualizarCarrito(); // Reflejar carrito en la pantalla
    }
}

// Guardar carrito en LocalStorage
function guardarCarritoEnLocalStorage() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

function checkout() {
    if (carrito.length === 0) {
        alert("El carrito está vacío. Agrega productos antes de pagar.");
        return;
    }

    const totalPrice = carrito.reduce((total, producto) => total + producto.precioTotal, 0);
    alert(`Compra realizada con éxito. Total: $${totalPrice.toFixed(2)}`);

    carrito = []; // Vaciar el carrito después de pagar
    localStorage.removeItem('carrito'); // Limpiar el LocalStorage
    actualizarCarrito();
}

window.onclick = function (event) {
    const modal = document.getElementById('resultados');
    if (event.target === modal) {
        closeModal();
    }
};