// products-list masonry layout

document.addEventListener("DOMContentLoaded", function() {
    var elem = document.querySelector('#cards');
    var msnry = new Masonry(elem, {
        itemSelector: '.card',
        columnWidth: '.card',
        gutter: 14,
        fitWidth: true,
    });
});

// cart managment

document.querySelectorAll('.add-to-cart').forEach((button) => {
    button.addEventListener('click', async () => {
        if (await cartApi('add', button.closest('.card').getAttribute('id'))) {
            const productCounter = button.parentElement.querySelector('.product-counter');

            button.parentElement.querySelector('.remove-from-cart').style.display = 'block';

            if (isNaN(parseInt(productCounter.textContent))) {
                productCounter.textContent = 1;
                return;
            }

            productCounter.textContent = parseInt(productCounter.textContent) + 1;
        }
    })
})

document.querySelectorAll('.remove-from-cart').forEach((button) => {
    button.addEventListener('click', async () => {
        if (await cartApi('remove', button.closest('.card').getAttribute('id'))) {
            const productCounter = button.parentElement.querySelector('.product-counter');

            productCounter.textContent = parseInt(productCounter.textContent) - 1;

            if (parseInt(productCounter.textContent) === 0) {
                button.style.display = 'none';
                productCounter.textContent = '';

                if (document.location.href.includes('cart.php')) {
                    button.closest('.card').remove();
                }
            }
        }
    })
})

async function cartApi(operation, productId) {
    const response = await fetch('/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `operation=${operation}&product=${productId}`
    });
    
    return response.ok;
}

