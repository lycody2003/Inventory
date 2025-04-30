<?php
session_start();
include('../include/db.php'); // Ensure DB connection

function getInventoryAnswer($question, $userId)
{
    global $pdo; // Use your global database connection

    $question = strtolower($question);

    // Handle the "supplier" query
    if (strpos($question, 'supplier') !== false) {
        $stmt = $pdo->prepare("SELECT name FROM suppliers WHERE user_id = ?");
        $stmt->execute([$userId]);
        $suppliers = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($suppliers) > 0) {
            $response = "<ul>";
            foreach ($suppliers as $supplier) {
                $response .= "<li>" . htmlspecialchars($supplier) . "</li>";
            }
            $response .= "</ul>";
        } else {
            $response = "<p>No suppliers available.</p>";
        }
        return $response;
    }

    // Handle the "category" query
    if (strpos($question, 'category') !== false) {
        $stmt = $pdo->prepare("SELECT name FROM categories WHERE user_id = ?");
        $stmt->execute([$userId]);
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($categories) > 0) {
            $response = "<ul>";
            foreach ($categories as $category) {
                $response .= "<li>" . htmlspecialchars($category) . "</li>";
            }
            $response .= "</ul>";
        } else {
            $response = "<p>No categories available.</p>";
        }
        return $response;
    }

    // Handle the "product" query (finding product details)
    if (strpos($question, 'product') !== false) {
        $stmt = $pdo->prepare("SELECT name, price, stock FROM products WHERE user_id = ?");
        $stmt->execute([$userId]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($products) > 0) {
            $response = "<ul>";
            foreach ($products as $product) {
                $response .= "<li><strong>" . htmlspecialchars($product['name']) . "</strong><br>Price: " . htmlspecialchars($product['price']) . "<br>Stock: " . htmlspecialchars($product['stock']) . "</li>";
            }
            $response .= "</ul>";
        } else {
            $response = "<p>No products available.</p>";
        }
        return $response;
    }

    // Handle the "stock" query (finding stock of a particular product)
    if (strpos($question, 'stock') !== false) {
        // Example: "stock of product X"
        preg_match('/stock of (.*)/i', $question, $matches);
        if (isset($matches[1])) {
            $productName = $matches[1];
            $stmt = $pdo->prepare("SELECT stock FROM products WHERE name = ? AND user_id = ?");
            $stmt->execute([$productName, $userId]);
            $stock = $stmt->fetchColumn();

            if ($stock !== false) {
                $response = "<p>Stock for '$productName': $stock</p>";
            } else {
                $response = "<p>Product '$productName' not found in your inventory.</p>";
            }
            return $response;
        }
    }

    // Handle the "find product by category" query
    if (strpos($question, 'find product') !== false && strpos($question, 'category') !== false) {
        preg_match('/find product in (.*)/i', $question, $matches);
        if (isset($matches[1])) {
            $categoryName = $matches[1];
            $stmt = $pdo->prepare("SELECT p.name, p.price, p.stock FROM products p JOIN categories c ON p.category_id = c.id WHERE c.name = ? AND p.user_id = ?");
            $stmt->execute([$categoryName, $userId]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($products) > 0) {
                $response = "<ul>";
                foreach ($products as $product) {
                    $response .= "<li><strong>" . htmlspecialchars($product['name']) . "</strong><br>Price: " . htmlspecialchars($product['price']) . "<br>Stock: " . htmlspecialchars($product['stock']) . "</li>";
                }
                $response .= "</ul>";
            } else {
                $response = "<p>No products found in the '$categoryName' category.</p>";
            }
            return $response;
        }
    }

    return "<p>Sorry, I do not understand this question.</p>";
}

// Process the user request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'] ?? 1; // Default to 1 for testing if not set
    $question = $_POST['question'] ?? '';
    echo getInventoryAnswer($question, $userId);
}
?>
