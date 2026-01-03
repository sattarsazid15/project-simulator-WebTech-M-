<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Browsing</title>
    <link rel="stylesheet" href="../assets/css/product_browse.css">
</head>
<body>

<h2>Product Browsing</h2>

<button onclick="loadProducts()">Available Products</button>

<br><br>

<input type="text" id="searchInput" placeholder="Search product name">
<button onclick="searchProducts()">Search</button>

<br><br>

<select id="typeFilter">
    <option value="">All Types</option>
    <option value="mobile">Mobile</option>
    <option value="computer">Computer</option>
    <option value="gadget">Gadget</option>
</select>

<select id="priceFilter">
    <option value="">All Prices</option>
    <option value="low">Below 50000</option>
    <option value="high">Above 50000</option>
</select>

<button onclick="applyFilters()">Apply Filters</button>
<button onclick="clearFilters()">Clear Filters</button>

<hr>

<div id="productList"></div>

<script src="../assets/js/product_browse.js"></script>
</body>
</html>
