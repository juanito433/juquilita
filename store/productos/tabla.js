const exportButton = document.querySelector(".export-btn");

const exportHTMLTableToCSV = (selector) => {
    // parse table for data
    const table = document.querySelector(selector);
    const rows = Array.from(table.rows);
    const teamMembers = rows.map((row) =>
        Array.from(row.cells).map(
            // if cell have multiple values use pipe symbol
            (cell) => cell.innerText.replace(/\n/g, "|")
        )
    );

    // construct CSV
    const csvContent =
        "data:text/csv;charset=utf-8," +
        teamMembers
            .map((teamMember) => Object.values(teamMember).join(","))
            .join("\n");

    // name file and download
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "Empleados.csv");
    document.body.appendChild(link);
    link.click();
};

exportButton.addEventListener("click", function () {
    exportHTMLTableToCSV(".table-widget > table");
});
document.addEventListener('DOMContentLoaded', () => {
    const rowsPerPage = 5; // Número de filas por página
    const rows = Array.from(document.querySelectorAll('#team-member-rows tr'));
    const pagination = document.querySelector('.pagination');
    let currentPage = 1;
    const numberOfPages = Math.ceil(rows.length / rowsPerPage);

    const displayRows = (page) => {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? '' : 'none';
        });
    };

    const setupPagination = () => {
        pagination.innerHTML = '';
        for (let i = 1; i <= numberOfPages; i++) {
            const link = document.createElement('a');
            link.href = '#';
            link.textContent = i;
            if (i === currentPage) {
                link.classList.add('active');
            }
            link.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                displayRows(currentPage);
                setupPagination();
            });
            const listItem = document.createElement('li');
            listItem.appendChild(link);
            pagination.appendChild(listItem);
        }
    };

    // Inicializa la paginación y muestra la primera página
    displayRows(currentPage);
    setupPagination();
});
function editarEmpleado(id) {
    // Aquí puedes redirigir a una página de edición o abrir un modal con el formulario de edición
    window.location.href = `edit/editar-productos.php?id=${id}`;
}

function eliminarEmpleado(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este empleado?')) {
        window.location.href = `delete/delete-productos.php?id=${id}`;
    }
}