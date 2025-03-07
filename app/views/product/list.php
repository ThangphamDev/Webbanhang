<?php include 'app/views/shares/header.php'; ?>

<!-- Banner quảng cáo -->
<div class="promo-banner">
    <div class="promo-content">
        <h2 class="promo-title">Khuyến Mãi Đặc Biệt Tháng 3</h2>
        <p class="promo-subtitle">Giảm giá lên đến <span class="highlight">33%</span> cho tất cả sản phẩm!</p>
        <a href="/promotion" class="promo-btn">Mua Ngay</a>
    </div>
</div>

<!-- CSS tùy chỉnh -->
<style>
    :root {
        --primary-color: #43a047;
        --primary-dark: #2e7d32;
        --primary-light: #a5d6a7;
        --white: #ffffff;
        --text-dark: #333333;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --edit-color: #ff9800;
        --delete-color: #f44336;
    }

    /* CSS cho Banner Quảng Cáo */
    .promo-banner {
        position: relative;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark), #1b5e20);
        color: var(--white);
        padding: 40px 20px;
        text-align: center;
        border-radius: 20px;
        margin: 30px auto;
        max-width: 900px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .promo-banner:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .promo-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        transform: rotate(30deg);
        pointer-events: none;
        animation: glow 8s infinite ease-in-out;
    }

    .promo-banner::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-light), var(--primary-color), var(--primary-dark));
        border-radius: 20px 20px 0 0;
    }

    .promo-content {
        position: relative;
        z-index: 1;
    }

    .promo-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
        letter-spacing: 1px;
        text-transform: uppercase;
        background: linear-gradient(135deg, var(--white), #e0f7fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInDown 1s ease-in-out;
    }

    .promo-subtitle {
        font-size: 1.2rem;
        font-weight: 300;
        margin-bottom: 20px;
        color: #f1f8e9;
        animation: fadeInUp 1s ease-in-out;
    }

    .highlight {
        font-weight: 700;
        color: #ffeb3b;
        font-size: 1.5rem;
        text-shadow: 0 0 10px rgba(255, 235, 59, 0.5);
    }

    .promo-btn {
        display: inline-block;
        background: linear-gradient(135deg, #ffca28, #f57f17);
        color: #fff;
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        text-decoration: none;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(255, 202, 40, 0.4);
        transition: all 0.3s ease;
    }

    .promo-btn:hover {
        background: linear-gradient(135deg, #f57f17, #ffca28);
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 202, 40, 0.6);
        color: #fff;
    }

    @keyframes glow {
        0% { transform: rotate(30deg) translateX(-20%); }
        50% { transform: rotate(30deg) translateX(20%); }
        100% { transform: rotate(30deg) translateX(-20%); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* CSS cho danh sách sản phẩm */
    .product-list-container {
        max-width: 1200px;
        margin: 40px auto;
    }
    
    .product-header {
        margin-bottom: 30px;
    }
    
    .product-title {
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }
    
    .btn-add-product {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
        color: var(--white);
        border-radius: 30px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(67, 160, 71, 0.3);
    }
    
    .btn-add-product:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(67, 160, 71, 0.4);
    }
    
    .product-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .product-img-container {
        position: relative;
        overflow: hidden;
        height: 220px;
    }
    
    .product-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.5s;
        padding: 10px;
    }
    
    .product-card:hover .product-img {
        transform: scale(1.05);
    }
    
    .product-category {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.6);
        color: var(--white);
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 30px;
        backdrop-filter: blur(5px);
        font-weight: 600;
    }
    
    .product-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .product-name {
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--text-dark);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 48px;
        line-height: 1.2;
    }
    
    .product-name a {
        color: inherit;
        text-decoration: none;
    }
    
    .product-description {
        color: #666;
        font-size: 0.875rem;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 42px;
        margin-top: 5px;
    }
    
    .product-price {
        font-weight: 700;
        font-size: 1.2rem;
        color: #e53935;
        margin-bottom: 15px;
        margin-top: auto;
    }

    .original-price {
        font-size: 0.9rem;
        color: var(--text-muted);
        text-decoration: line-through;
        margin-right: 10px;
    }

    .discount-label {
        font-size: 0.85rem;
        color: #ff5722;
        font-weight: 600;
    }
    
    .product-actions {
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #eee;
        padding-top: 15px;
        margin-top: auto;
        gap: 10px;
        flex-wrap: nowrap;
        overflow: visible;
    }
    
    .btn-edit, .btn-delete, .btn-add-to-cart {
        font-size: 0.9rem;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 20px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 75px;
        white-space: nowrap;
    }
    
    .btn-edit {
        color: var(--edit-color);
        background-color: rgba(255, 152, 0, 0.1);
        border: 1px solid var(--edit-color);
    }
    
    .btn-edit:hover {
        background-color: var(--edit-color);
        color: var(--white);
        box-shadow: 0 2px 8px rgba(255, 152, 0, 0.3);
        transform: translateY(-1px);
    }
    
    .btn-delete {
        color: var(--delete-color);
        background-color: rgba(244, 67, 54, 0.1);
        border: 1px solid var(--delete-color);
    }
    
    .btn-delete:hover {
        background-color: var(--delete-color);
        color: var(--white);
        box-shadow: 0 2px 8px rgba(244, 67, 54, 0.3);
        transform: translateY(-1px);
    }
    
    .btn-add-to-cart {
        color: var(--white);
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
    }
    
    .btn-add-to-cart:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        box-shadow: 0 2px 8px rgba(67, 160, 71, 0.4);
        transform: translateY(-1px);
    }
    
    .btn-edit i, .btn-delete i, .btn-add-to-cart i {
        margin-right: 5px;
    }
    
    .no-image-placeholder {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f5f5f5;
        color: #aaa;
    }
    
    .empty-products {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 60px 30px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #aaa;
        margin-bottom: 20px;
    }
    
    .shine-effect {
        position: relative;
        overflow: hidden;
    }
    
    .shine-effect::before {
        position: absolute;
        top: 0;
        left: -75%;
        z-index: 2;
        display: block;
        content: '';
        width: 50%;
        height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 100%);
        transform: skewX(-25deg);
    }
    
    .product-card:hover .shine-effect::before {
        animation: shine 0.75s;
    }
    
    @keyframes shine {
        100% { left: 125%; }
    }
</style>

<div class="product-list-container">
    <div class="product-header d-flex justify-content-between align-items-center">
        <h1 class="product-title">Danh sách sản phẩm</h1>
        <a href="/Product/add" class="btn btn-add-product">
            <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
        </a>
    </div>

    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-container shine-effect">
                            <?php if (!empty($product->image)): ?>
                                <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                     alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                     class="product-img">
                            <?php else: ?>
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <p class="mb-0">Không có ảnh</p>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($product->category_name)): ?>
                                <span class="product-category">
                                    <i class="fas fa-tag me-1"></i><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-content">
                            <h3 class="product-name">
                                <a href="/Product/show/<?php echo $product->id; ?>">
                                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h3>
                            
                            <p class="product-description">
                                <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            
                            <div class="product-price">
                                <?php 
                                    $original_price = $product->price * 3/2; // Giá gốc gấp đôi giá hiện tại
                                    $current_price = $product->price; // Giá hiện tại
                                ?>
                                <span class="original-price"><?php echo number_format($original_price, 0, ',', '.'); ?> ₫</span>
                                <span><?php echo number_format($current_price, 0, ',', '.'); ?> ₫</span>
                                <div class="discount-label">Giảm 33%</div>
                            </div>
                            
                            <div class="product-actions">
                                <a href="/Product/edit/<?php echo $product->id; ?>" class="btn btn-edit">
                                    <i class="fas fa-edit me-1"></i> Sửa
                                </a>
                                <a href="/Product/delete/<?php echo $product->id; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    <i class="fas fa-trash-alt me-1"></i> Xóa
                                </a>
                                <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-add-to-cart">
                                    <i class="fas fa-shopping-cart me-1"></i> Giỏ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-products">
            <div class="empty-icon">
                <i class="fas fa-shopping-basket"></i>
            </div>
            <h3>Chưa có sản phẩm nào</h3>
            <p class="text-muted">Hãy thêm sản phẩm đầu tiên của bạn bằng cách nhấn nút "Thêm sản phẩm mới"</p>
            <a href="/Product/add" class="btn btn-add-product mt-3">
                <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm ngay
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>