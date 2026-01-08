function deleteProduct(id) {
    if (!confirm('Are you sure you want to delete this product?')) {
        return;
    }
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/productController.php', true); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('action=delete&id=' + id);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            if (response.status === 'success') {
                let row = document.getElementById('row-' + id);
                if (row) {
                    row.parentNode.removeChild(row);
                }
                alert("Product deleted successfully!");
            } else {
                alert("Failed to delete product.");
            }
        }
    };
}


function fetchProductDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) return;

    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../controllers/productController.php?action=get_product&id=' + id, true); // Updated URL
    xhttp.send();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let product = JSON.parse(this.responseText);
            
            if (product) {
                document.getElementById('product-name').value = product.name;
                document.getElementById('product-price').value = product.price;
                document.getElementById('product-desc').value = product.description;
                document.getElementById('product-type').value = product.type;
                document.getElementById('current-image').src = "../assets/uploads/" + product.image;
            } else {
                alert("Product not found.");
            }
        }
    };
}


function searchProducts() {
    let query = document.getElementById('search-input').value;
    loadProducts('search', query);
}


function filterProducts() {
    let type = document.getElementById('filter-select').value;
    loadProducts('filter', type);
}

function loadProducts(action, value) {
    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../controllers/productController.php?action=' + action + '&value=' + value, true); // Updated URL
    xhttp.send();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let products = JSON.parse(this.responseText);
            let container = document.getElementById('products-box');
            let html = '<h2>Available Products</h2>';

            if (products.length > 0) {
                products.forEach(function(product) {
                    html += `
                    <div class="product-card" data-type="${product.type.toLowerCase()}">
                        <img src="../assets/uploads/${product.image}" alt="Product Image">
                        <b>${product.name}</b><br>
                        <span class="product-price">Tk ${product.price}</span><br><br>
                        
                        <a href="guestProductDetails.php?id=${product.id}">
                            <button>View Details</button>
                        </a>`;

                    if (typeof isGuest !== 'undefined' && isGuest) {
                        html += `<button onclick="loginAlert()">Add to Cart</button>`;
                    } else {
                        html += `
                        <form method="POST" action="../controllers/cartController.php" class="cart-form">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="id" value="${product.id}">
                            <button type="submit" class="btn-cart">Add to Cart</button>
                        </form>`;
                    }

                    html += `</div>`;
                });
            } else {
                html += "<p class='no-products'>No products found.</p>";
            }
            container.innerHTML = html;
        }
    };
}

function toggleWishlist(productId, btnElement) {
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/productController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('action=toggle_wishlist&id=' + productId);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            
            if (response.status === 'unauthorized') {
                alert("Please login to use the wishlist!");
                window.location.href = 'customerLogin.php';
            } else if (response.status === 'added') {
                btnElement.classList.add('heart-active');
                btnElement.innerHTML = '&#10084;'; 
            } else if (response.status === 'removed') {
                btnElement.classList.remove('heart-active');
                btnElement.innerHTML = '&#9825;';
                
                let card = document.getElementById('card-' + productId);
                if(card && window.location.href.includes("wishlist.php")){
                    card.remove();
                    if(document.querySelectorAll('.product-card').length === 0){
                        location.reload();
                    }
                }
            }
        }
    };
}

function checkEmail(){
    let email = document.getElementById("email").value;

    if(email === ""){
        document.getElementById("email-msg").innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/ajaxCheckEmail.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);

    xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        let res = this.responseText.trim();

        if(res === "exists"){
            document.getElementById("email-msg").innerHTML =
                "<span style='color:red'>Email already exists</span>";
        } else {
            document.getElementById("email-msg").innerHTML =
                "<span style='color:green'>Email available</span>";
        }
    }
}
}

function checkTechEmail(){
    let email = document.getElementById("email").value;
    let msg = document.getElementById("email-msg");

    if(email === ""){
        msg.innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/ajaxCheckTechnician.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText.trim() === "email_exists"){
                msg.innerHTML = "<span style='color:red'>Email already exists</span>";
            } else {
                msg.innerHTML = "<span style='color:green'>Email available</span>";
            }
        }
    }
}

function checkTechUsername(){
    let username = document.getElementById("username").value;
    let msg = document.getElementById("username-msg");

    if(username === ""){
        msg.innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controllers/ajaxCheckTechnician.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText.trim() === "username_exists"){
                msg.innerHTML = "<span style='color:red'>Username already exists</span>";
            } else {
                msg.innerHTML = "<span style='color:green'>Username available</span>";
            }
        }
    }
}

function updateOrderStatus(orderId) {
    let selectBox = document.getElementById('status-select-' + orderId);
    let newStatus = selectBox.value;

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/orderController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhttp.send('action=update_status&id=' + orderId + '&status=' + newStatus);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            
            if (response.status === 'success') {
                alert("Status updated successfully to " + newStatus + "!");
                
                let statusCell = document.getElementById('status-text-' + orderId);
                statusCell.innerText = newStatus;
                
                statusCell.className = 'status-' + newStatus;
            } else {
                alert("Failed to update status: " + (response.message || "Unknown error"));
            }
        }
    };
}

function updateCartQty(productId, inputElement) {
    let newQty = inputElement.value;

    if (newQty < 1) { newQty = 1; inputElement.value = 1; }
    if (newQty > 5) { newQty = 5; inputElement.value = 5; alert("Max quantity is 5"); }

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/cartController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('action=update_qty_ajax&id=' + productId + '&qty=' + newQty);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            
            if (response.status === 'success') {
                document.getElementById('subtotal-' + productId).innerText = 'Tk ' + response.subtotal;
                document.getElementById('grand-total').innerText = 'Tk ' + response.grandTotal;
                document.getElementById('input-total-amount').value = response.grandTotal;
            }
        }
    };
}

function removeCartItem(productId) {
    if(!confirm("Remove this item from cart?")) return;

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controllers/cartController.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('action=remove_item_ajax&id=' + productId);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            
            if (response.status === 'success') {
                let row = document.getElementById('cart-row-' + productId);
                if(row) row.remove();

                document.getElementById('grand-total').innerText = 'Tk ' + response.grandTotal;
                document.getElementById('input-total-amount').value = response.grandTotal;

                if (response.isEmpty) {
                    location.reload();
                }
            }
        }
    };
}
