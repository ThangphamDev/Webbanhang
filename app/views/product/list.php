<?php include 'app/views/shares/header.php'; ?>
<link rel="stylesheet" href="/public/css/list.css">
<style>
    
</style>
<!-- Banner quảng cáo hiện đại -->
<div class="hero-banner">
    <div class="container">
        <div class="banner-wrapper">
            <div class="banner-content">
                <span class="promo-label">Ưu đãi tháng 3</span>
                <h1 class="banner-title">Giảm giá đến <span class="highlight">33%</span></h1>
                <p class="banner-subtitle">Nhập mã <span class="promo-code">SPRING33</span> khi thanh toán</p>
                <div class="banner-cta">
                    <a href="/promotion" class="btn-primary">Khám phá ngay</a>
                    <a href="/collections/bestsellers" class="btn-secondary">Xem sản phẩm bán chạy</a>
                </div>
            </div>
            <!-- Thay thế phần decoration bằng hình ảnh banner -->
            <div class="banner-image-right">
                <img src="/public/images/banner.jpg" alt="Banner khuyến mãi tháng 3" class="banner-img">
            </div>
        </div>
    </div>
</div>

<!-- Phần danh mục sản phẩm -->
<div class="container">
    <div class="section-catalog">
        <!-- Điều hướng và tìm kiếm -->
        <div class="catalog-header">
            <div class="breadcrumb">
                <a href="/" class="breadcrumb-item">Trang chủ</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">Danh sách sản phẩm</span>
            </div>
            
            <div class="catalog-tools">
                <div class="search-box">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..." class="search-input">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="filter-sort">
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <i class="fas fa-sort-amount-down"></i>
                            <span>Sắp xếp</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item active">Phổ biến nhất</a>
                            <a href="#" class="dropdown-item">Giá: Thấp đến cao</a>
                            <a href="#" class="dropdown-item">Giá: Cao đến thấp</a>
                            <a href="#" class="dropdown-item">Mới nhất</a>
                        </div>
                    </div>
                    
                    <div class="view-options">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bộ lọc và danh sách sản phẩm -->
        <div class="catalog-content">
            <!-- Bộ lọc bên trái -->
            <div class="catalog-sidebar">
                <div class="sidebar-heading">
                    <h3>Bộ lọc</h3>
                    <button class="btn-clear-filter">Xóa tất cả</button>
                </div>
                
                <div class="filter-group">
                    <h4 class="filter-title">Danh mục</h4>
                    <div class="filter-options">
                        <label class="filter-option">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            <span class="option-name">Tất cả</span>
                            <span class="option-count">132</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <span class="option-name">Điện thoại</span>
                            <span class="option-count">45</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <span class="option-name">Máy tính</span>
                            <span class="option-count">32</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <span class="option-name">Phụ kiện</span>
                            <span class="option-count">55</span>
                        </label>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h4 class="filter-title">Giá</h4>
                    <div class="price-range">
                        <div class="range-slider">
                            <div class="range-track">
                                <div class="range-selection"></div>
                            </div>
                            <div class="range-thumb range-thumb-min"></div>
                            <div class="range-thumb range-thumb-max"></div>
                        </div>
                        <div class="range-values">
                            <span>0đ</span>
                            <span>10.000.000đ</span>
                        </div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h4 class="filter-title">Đánh giá</h4>
                    <div class="filter-options">
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="option-count">84</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="option-count">32</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="option-count">10</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <div class="star-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="option-count">6</span>
                        </label>
                    </div>
                </div>
                
                <a href="/Product/add" class="btn-add-product sidebar-cta">
                    <i class="fas fa-plus-circle"></i>
                    <span>Thêm sản phẩm mới</span>
                </a>
            </div>
            
            <!-- Danh sách sản phẩm chính -->
            <div class="catalog-main">
                <?php if (!empty($products)): ?>
                    <div class="product-grid">
                        <?php foreach ($products as $product): ?>
                            <div class="product-card">
                                <div class="product-badges">
                                    <span class="badge badge-sale">-33%</span>
                                    <?php if (rand(0, 1)): ?>
                                        <span class="badge badge-new">New</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-actions-quick">
                                    <button class="action-btn btn-wishlist" title="Thêm vào yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-btn btn-compare" title="So sánh">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>
                                    <button class="action-btn btn-quickview" title="Xem nhanh">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                
                                <div class="product-thumb">
                                    <a href="/Product/show/<?php echo $product->id; ?>" class="image-wrapper">
                                        <?php if (!empty($product->image)): ?>
                                            <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                                alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                                class="product-img">
                                        <?php else: ?>
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    
                                    <div class="hover-action">
                                        <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn-add-to-cart">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>Thêm vào giỏ</span>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="product-info">
                                    <?php if (!empty($product->category_name)): ?>
                                        <div class="product-category">
                                            <a href="/category/<?php echo strtolower($product->category_name); ?>">
                                                <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h3 class="product-name">
                                        <a href="/Product/show/<?php echo $product->id; ?>">
                                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="product-rating">
                                        <div class="stars">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="rating-count">(<?php echo rand(12, 150); ?>)</span>
                                    </div>
                                    
                                    <div class="product-price">
                                        <?php 
                                            $original_price = $product->price * 3/2;
                                            $current_price = $product->price;
                                        ?>
                                        <span class="price-old"><?php echo number_format($original_price, 0, ',', '.'); ?>₫</span>
                                        <span class="price-current"><?php echo number_format($current_price, 0, ',', '.'); ?>₫</span>
                                    </div>
                                    
                                    <div class="product-description">
                                        <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                                    </div>
                                    
                                    <div class="product-actions-admin">
                                        <a href="/Product/edit/<?php echo $product->id; ?>" class="action-link edit-link">
                                            <i class="fas fa-edit"></i>
                                            <span>Sửa</span>
                                        </a>
                                        <a href="/Product/delete/<?php echo $product->id; ?>" 
                                            class="action-link delete-link" 
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Xóa</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="pagination">
                        <a href="#" class="page-item prev disabled">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="page-item active">1</a>
                        <a href="#" class="page-item">2</a>
                        <a href="#" class="page-item">3</a>
                        <span class="page-dots">...</span>
                        <a href="#" class="page-item">10</a>
                        <a href="#" class="page-item next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h2 class="empty-state-title">Chưa có sản phẩm nào</h2>
                        <p class="empty-state-description">Hãy thêm sản phẩm đầu tiên của bạn để bắt đầu kinh doanh</p>
                        <a href="/Product/add" class="btn-add-product empty-state-cta">
                            <i class="fas fa-plus-circle"></i>
                            <span>Thêm sản phẩm ngay</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php include 'app/views/shares/footer.php'; ?>