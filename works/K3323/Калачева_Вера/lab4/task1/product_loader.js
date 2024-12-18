// Функция для загрузки товаров из базы данных
function loadProducts() {
    fetch('select_products.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('productContainer');
            container.innerHTML = '';

            data.forEach(product => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'products[]';
                checkbox.value = product.id;

                const label = document.createElement('label');
                label.textContent = product.product;

                const div = document.createElement('div');
                div.appendChild(checkbox);
                div.appendChild(label);

                container.appendChild(div);
            });
        })
        .catch(error => console.error('Ошибка:', error));
}

// Вызываем функцию при загрузке страницы
window.onload = loadProducts;
