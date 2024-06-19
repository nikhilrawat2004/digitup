<!DOCTYPE html>
<html>
<head>
  <title>Order Confirmation</title>
  <link rel="stylesheet" type="text/css" href="order-confirmation.css">
  
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

        #print-button, #back-button {
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
  <h1>Order Confirmation</h1>
  <table id="order">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody id="order-items">
    </tbody>
  </table>
  <div id="total">Total: ₹<span id="total-price"></span></div>
  <button id="print-button">Print Order</button>
  <button id="back-button">Back to Home</button>
  <script>
    const order = document.getElementById('order')
    const orderItems = document.getElementById('order-items')
    const totalPrice = document.getElementById('total-price')
    const printButton = document.getElementById('print-button')
    const backButton = document.getElementById('back-button')

    // Fetch the ordered data from the server
    fetch('order-data.php')
    .then(response => response.json())
    .then(data => {
        // Generate the order items table
        let orderItemsHTML = ''
        data.items.forEach(item => {
        orderItemsHTML += `
            <tr>
            <td><img src="${item.image}" alt="${item.name}"></td>
            <td>${item.name}</td>
            <td>${item.quantity}</td>
            <td>₹${item.price}</td>
            </tr>
        `
        })
        orderItems.innerHTML = orderItemsHTML

        // Calculate the total price
        let total = 0
        data.items.forEach(item => {
        total += item.quantity * item.price
        })
        totalPrice.innerText = total.toFixed(2)
    })

    // Print the order
    printButton.addEventListener('click', () => {
    window.print()
    })

    // Go back to the home page
    backButton.addEventListener('click', () => {
    window.location.href = 'index.html'
    })
  </script>
</body>
</html>