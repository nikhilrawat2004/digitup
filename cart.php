<!DOCTYPE html>
<html>
<head>
  <title>Cart</title>
  <link rel="stylesheet" type="text/css" href="cart.css">
  <script src="cart"></script>
  <style>
    body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    }

    table {
    width: 100%;
    border-collapse: collapse;
    }

    th, td {
    padding: 10px;
    border: 1px solid #ddd;
    }

    .quantity-button {
    padding: 5px;
    margin: 0 5px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    }

    .remove-button {
    padding: 5px;
    margin: 0 5px;
    background-color: #f44336;
    color: white;
    border: none;
    cursor: pointer;
    }

    #total {
    font-size: 24px;
    font-weight: bold;
    margin-top: 20px;
    }

    #checkout-button {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Cart</h1>
  <table id="cart">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  <div id="total">Total: ₹179.98</div>
  <button id="checkout-button" onclick="">Checkout</button>

  <script>
  const cart = document.getElementById('cart');
  const total = document.getElementById('total');

  // Update the total price of cart
  function updateTotal() {
    let totalPrice = 0;
    const rows = cart.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
      const quantity = rows[i].getElementsByTagName('span')[0].innerText;
      const price = rows[i].getElementsByTagName('td')[3].innerText;
      totalPrice += parseFloat(price) * parseInt(quantity);
    }
    total.innerText = 'Total: ₹' + totalPrice.toFixed(2);
  }

  // Remove a product from the cart
  function removeProduct(event) {
    const button = event.target;
    const row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
    updateTotal();
  }

  // Adjust the quantity of a product
  function adjustQuantity(event) {
    const button = event.target;
    const row = button.parentNode.parentNode;
    const quantity = row.getElementsByTagName('span')[0];
    const currentQuantity = parseInt(quantity.innerText);
    const direction = button.getAttribute('data-direction');
    const newQuantity = currentQuantity + parseInt(direction);
    if (newQuantity >= 1) {
      quantity.innerText = newQuantity;
      updateTotal();
    }
  }

  // Add event listeners to the remove and quantity buttons
  const removeButtons = document.getElementsByClassName('remove-button');
  for (let i = 0; i < removeButtons.length; i++) {
    removeButtons[i].addEventListener('click', removeProduct);
  }

  const quantityButtons = document.getElementsByClassName('quantity-button');
  for (let i = 0; i < quantityButtons.length; i++) {
    quantityButtons[i].addEventListener('click', adjustQuantity);
  }

  // Initialize the cart with some sample products
  const products = [
    {
      name: 'Pizza',
      image: 'pizza.jpg',
      price: 99.99
    },
    {
      name: 'Burger',
      image: 'burger.jpg',
      price: 79.99
    }
  ];

  for (let i = 0; i < products.length; i++) {
    const product = products[i];
    const row = `
            <tr>
            <td><img src="${product.image}" alt="${product.name}"></td>
            <td>${product.name}</td>
            <td><button class="quantity-button" data-direction="-1">-</button> <span>1</span> <button class="quantity-button" data-direction="1">+</button></td>
            <td>₹${product.price}</td>
            <td><button class="remove-button">Remove</button></td>
            </tr>
        `;
    cart.getElementsByTagName('tbody')[0].innerHTML += row;
  }

  // Update the total price of the cart
  updateTotal();
</script>

</body>
</html>