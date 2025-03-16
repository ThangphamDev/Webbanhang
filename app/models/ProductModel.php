<?php 
class ProductModel 
{ 
    private $conn; 
    private $table_name = "product"; 
 
    public function __construct($db) 
    { 
        $this->conn = $db; 
    } 
 
    public function getProducts() 
    { 
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as 
category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN category c ON p.category_id = c.id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        $result = $stmt->fetchAll(PDO::FETCH_OBJ); 
        return $result; 
    } 

    public function getFilteredProducts($category_id = null, $min_price = 0, $max_price = null, $rating = null) 
{
    $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name,
              c.id as category_id 
              FROM " . $this->table_name . " p 
              LEFT JOIN category c ON p.category_id = c.id
              WHERE 1=1";
    
    $params = [];
    
    if ($category_id !== null && $category_id !== 'all') {
        $query .= " AND p.category_id = :category_id";
        $params[':category_id'] = $category_id;
    }
    
    if ($min_price !== null) {
        $query .= " AND p.price >= :min_price";
        $params[':min_price'] = $min_price;
    }
    
    if ($max_price !== null) {
        $query .= " AND p.price <= :max_price";
        $params[':max_price'] = $max_price;
    }
    
    // Giả sử có trường rating trong database. Nếu không có, bạn có thể bỏ phần này
    if ($rating !== null) {
        $query .= " AND p.rating >= :rating";
        $params[':rating'] = $rating;
    }
    
    $stmt = $this->conn->prepare($query);
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
    
 
    public function getProductById($id) 
    { 
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':id', $id); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ); 
        return $result; 
    } 
 
    public function addProduct($name, $description, $price, $category_id, $image) 
    { 
        $errors = []; 
        if (empty($name)) { 
            $errors['name'] = 'Tên sản phẩm không được để trống'; 
        } 
        if (empty($description)) { 
            $errors['description'] = 'Mô tả không được để trống'; 
        } 
        if (!is_numeric($price) || $price < 0) { 
            $errors['price'] = 'Giá sản phẩm không hợp lệ'; 
        } 
        if (count($errors) > 0) { 
            return $errors; 
        } 
 
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, 
category_id, image) VALUES (:name, :description, :price, :category_id, :image)"; 
        $stmt = $this->conn->prepare($query); 
 
        $name = htmlspecialchars(strip_tags($name)); 
        $description = htmlspecialchars(strip_tags($description)); 
        $price = htmlspecialchars(strip_tags($price)); 
        $category_id = htmlspecialchars(strip_tags($category_id)); 
        $image = htmlspecialchars(strip_tags($image)); 
 
        $stmt->bindParam(':name', $name); 
        $stmt->bindParam(':description', $description); 
        $stmt->bindParam(':price', $price); 
        $stmt->bindParam(':category_id', $category_id); 
        $stmt->bindParam(':image', $image); 
 
        if ($stmt->execute()) { 
            return true; 
        } 
 
        return false; 
    } 
 
    public function updateProduct($id, $name, $description, $price, $category_id, 
$image) 
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, 
description=:description, price=:price, category_id=:category_id, image=:image WHERE 
id=:id"; 
$stmt = $this->conn->prepare($query); 
$name = htmlspecialchars(strip_tags($name)); 
$description = htmlspecialchars(strip_tags($description)); 
$price = htmlspecialchars(strip_tags($price)); 
$category_id = htmlspecialchars(strip_tags($category_id)); 
$image = htmlspecialchars(strip_tags($image)); 
$stmt->bindParam(':id', $id); 
$stmt->bindParam(':name', $name); 
$stmt->bindParam(':description', $description); 
$stmt->bindParam(':price', $price); 
$stmt->bindParam(':category_id', $category_id); 
$stmt->bindParam(':image', $image); 
if ($stmt->execute()) { 
return true; 
} 
return false; 
} 
public function deleteProduct($id) 
{ 
$query = "DELETE FROM " . $this->table_name . " WHERE id=:id"; 
$stmt = $this->conn->prepare($query); 
$stmt->bindParam(':id', $id); 
if ($stmt->execute()) { 
return true; 
} 
return false; 
} 
} 
?>