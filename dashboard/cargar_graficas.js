// Función para traducir días de la semana
const translateDay = (day) => {
    const days = {
        "Sunday": "Domingo",
        "Monday": "Lunes",
        "Tuesday": "Martes",
        "Wednesday": "Miércoles",
        "Thursday": "Jueves",
        "Friday": "Viernes",
        "Saturday": "Sábado"
    };
    return days[day] || day; // Retorna el nombre del día en español
};

// Función para traducir meses
const translateMonth = (month) => {
    const months = {
        "January": "Enero",
        "February": "Febrero",
        "March": "Marzo",
        "April": "Abril",
        "May": "Mayo",
        "June": "Junio",
        "July": "Julio",
        "August": "Agosto",
        "September": "Septiembre",
        "October": "Octubre",
        "November": "Noviembre",
        "December": "Diciembre"
    };
    return months[month] || month; // Retorna el mes en español
};

// Función para obtener las fechas de inicio y fin de una semana
const getWeekRange = (year, week) => {
    const date = new Date(year, 0, (week - 1) * 7 + 1); // Establecer el primer día de la semana
    const startDate = new Date(date);
    startDate.setDate(date.getDate() - date.getDay()); // Ajustar al inicio de la semana
    const endDate = new Date(startDate);
    endDate.setDate(startDate.getDate() + 6); // Ajustar al final de la semana
    return `${startDate.getDate()}-${endDate.getDate()}`; // Retorna rango de fechas de la semana
};

// Llamadas a las APIs PHP para obtener los datos
async function fetchData(endpoint) {
    const response = await fetch(endpoint);
    return await response.json();
}

// Gráfica de ventas por día de la semana
fetchData('./ventas_dia.php').then(data => {
    // Traducir días de la semana
    const translatedLabels = data.labels.map(day => translateDay(day));

    const ctx = document.getElementById('ventasDia').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: translatedLabels, // Etiquetas traducidas
            datasets: [{
                label: 'Ventas por Día',
                data: data.values,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });
});

// Gráfica de ventas por semanas del mes actual

fetchData('./ventas_semanas.php').then(data => {
    // Traducir semanas y formatear con el rango de fechas
    console.log(data);
    const translatedLabels = data.labels.map((week, index) => {
        const month = translateMonth(data.month); // Traducir mes
        const weekRange = getWeekRange(data.year, index + 1); // Obtener el rango de la semana
        const label = `${month} ${weekRange}`;
        console.log(label); // Verificar la etiqueta generada
        return label;
    });

    const ctx = document.getElementById('ventasSemana').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: translatedLabels, // Etiquetas de semanas traducidas
            datasets: [{
                label: 'Ventas por Semana',
                data: data.values,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });
});



// Gráfica de ventas anuales
fetchData('./ventas_meses.php').then(data => {
    // Traducir meses
    const translatedLabels = data.labels.map(month => translateMonth(month));
    console.log(data); // Verificar el contenido de la respuesta

    const ctx = document.getElementById('ventasAnuales').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: translatedLabels, // Etiquetas de meses traducidas
            datasets: [{
                label: 'Ventas Anuales',
                data: data.values,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                borderWidth: 1
            }]
        }
    });
});

// Lista de productos más vendidos
fetchData('./productos_mas_vendidos.php').then(data => {
    const lista = document.getElementById('productosMasVendidos');
    data.forEach(producto => {
        const item = document.createElement('li');
        item.textContent = `${producto.nombre}: ${producto.cantidad} vendidos`;
        lista.appendChild(item);
    });
});

// Función para obtener los mejores choferes desde la base de datos
async function fetchBestDrivers() {
    const response = await fetch('./mejores_choferes.php');
    const data = await response.json();
    console.log(data);
    const lista = document.getElementById('mejoresChoferes');  // El elemento donde mostrarás la lista

    // Limpiar la lista antes de agregar los nuevos datos
    lista.innerHTML = '';

    data.forEach(chofer => {
        const item = document.createElement('li');
        item.textContent = `Chofer: ${chofer.nombre}, Total de envíos: ${chofer.total_envios}`;
        lista.appendChild(item);
    });
}

// Llamar a la función para cargar los mejores choferes
fetchBestDrivers();
