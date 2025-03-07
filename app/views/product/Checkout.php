<style> 
    :root {
    /* Color Palette */
    --primary-color: #2563eb;      /* Modern blue */
    --primary-dark: #1d4ed8;       /* Darker blue */
    --background-light: #f4f7ff;   /* Soft blue-gray background */
    --text-primary: #1f2937;       /* Dark gray for text */
    --text-secondary: #6b7280;     /* Muted gray */
    --border-color: #e5e7eb;       /* Light gray border */
    --white: #ffffff;
    --success-color: #22c55e;      /* Green for success */
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', 'Segoe UI', Roboto, system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: var(--background-light);
    color: var(--text-primary);
    line-height: 1.6;
}

.container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: var(--white);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
}

h1 {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: -0.025em;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-control:invalid {
    border-color: #ef4444;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 0.75rem 1.25rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: var(--primary-color);
    color: var(--white);
    margin-top: 1rem;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
}

.btn-secondary {
    background-color: var(--background-light);
    color: var(--text-primary);
    margin-top: 1rem;
}

.btn-secondary:hover {
    background-color: color-mix(in srgb, var(--background-light) 85%, var(--text-primary));
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        width: 95%;
        margin: 1rem auto;
        padding: 1.5rem;
    }

    h1 {
        font-size: 1.5rem;
    }

    .form-control {
        padding: 0.625rem 0.875rem;
    }

    .btn {
        padding: 0.625rem 1rem;
    }
}

/* Form Validation Styles */
input:required:invalid, 
textarea:required:invalid {
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>') no-repeat right 10px center;
    background-size: 24px;
}

/* Optional: Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--background-light);
}

::-webkit-scrollbar-thumb {
    background-color: var(--primary-color);
    border-radius: 4px;
}
</style>

<div class="container">
    <h1>
        <i class="fas fa-shopping-cart me-2"></i>Thanh Toán
    </h1>
    <form method="POST" action="/Product/processCheckout" novalidate>
        <div class="form-group">
            <label for="name">Họ tên</label>
            <input type="text" id="name" name="name" class="form-control" 
                   required pattern="^[A-Za-zÀ-ỹ\s]{2,50}$" 
                   title="Vui lòng nhập tên hợp lệ (2-50 ký tự)">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" class="form-control" 
                   required pattern="^(0[3|5|7|8|9])+([0-9]{8})$" 
                   title="Vui lòng nhập số điện thoại hợp lệ">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <textarea id="address" name="address" class="form-control" 
                      required minlength="5" maxlength="250" 
                      title="Vui lòng nhập địa chỉ chi tiết (5-250 ký tự)"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check me-2"></i>Thanh Toán
        </button>
    </form>
    <a href="/Product/cart" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Quay Lại Giỏ Hàng
    </a>
</div>