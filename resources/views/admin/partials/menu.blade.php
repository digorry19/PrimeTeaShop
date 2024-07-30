<!-- resources/views/admin/partials/menu.blade.php -->

<div class="list-group">
    <img src="https://demo.hasthemes.com/rongcha/img/logo/logo.png" width="200px" style="margin:" alt="">
    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">
        Danh mục <span class="badge badge-primary badge-pill"></span>
    </a>
    <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">
        Danh sách sản phẩm <span class="badge badge-primary badge-pill"></span>
    </a>
</div>
