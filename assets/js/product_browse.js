let allProducts = [];

function loadProducts() {
    fetch("../controllers/product_browse_controller.php")
        .then(response => response.json())
        .then(data => {
            allProducts = data;
            displayProducts(allProducts);
        });
}
function displayProducts(products) {
    let container = document.getElementById("productList");
    container.innerHTML = "";

    if (products.length === 0) {
        container.innerHTML = "No products found.";
        return;
    }
    products.forEach(product => {
        let card = document.createElement("div");
        card.innerHTML =
            "<p><b>Name:</b> " + product.name + "</p>" +
            "<p><b>Type:</b> " + product.type + "</p>" +
            "<p><b>Price:</b> " + product.price + "</p>" +
            "<hr>";
        container.appendChild(card);
    });
}

function searchProducts() {
    let keyword = document.getElementById("searchInput").value.toLowerCase();

    let filtered = allProducts.filter(product => {
        return product.name.toLowerCase().includes(keyword);
    });

    displayProducts(filtered);
}

function applyFilters() {
    let type = document.getElementById("typeFilter").value;
    let price = document.getElementById("priceFilter").value;

    let filtered = allProducts.filter(product => {

        let typeMatch = true;
        let priceMatch = true;

        if (type !== "") {
            typeMatch = product.type === type;
        }

        if (price === "low") {
            priceMatch = parseInt(product.price) < 50000;
        }

        if (price === "high") {
            priceMatch = parseInt(product.price) >= 50000;
        }

        return typeMatch && priceMatch;
    });

    displayProducts(filtered);
}

function clearFilters() {
    document.getElementById("searchInput").value = "";
    document.getElementById("typeFilter").value = "";
    document.getElementById("priceFilter").value = "";

    displayProducts(allProducts);
}
