@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="banner">
            <div class="banner-content">
                <h1>Cart</h1>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (count($cartItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá mỗi sản phẩm</th>
                        <th>Tổng giá</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr data-product-id="{{ $item['product']->id }}">
                            <td><img src="{{ asset('storage/' . $item['product']->image) }}"
                                    alt="{{ $item['product']->name }}" style="width: 100px;"></td>
                            <td>{{ $item['product']->name }}</td>
                            <td>
                                <input type="number" class="quantity" value="{{ $item['quantity'] }}" min="1">
                            </td>
                            <td>${{ $item['product']->price }}</td>
                            <td class="total-price">
                                ${{ $item['product']->price * $item['quantity'] }}
                            </td>
                            <td>
                                <button class="btn btn-danger delete-item">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <input type="text" name="address" placeholder="Address..">
                <!-- Thêm các trường dữ liệu khác nếu cần -->
                <button type="submit" class="btn btn-primary">Thanh toán</button>
                </form>
            @else
                <p>Giỏ hàng của bạn đang trống.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateQuantity = async (productId, quantity) => {
                try {
                    const response = await fetch('{{ route('cart.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    });
                    const data = await response.json();
                    if (data.success) {
                        // Update the row total price
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        const price = row.querySelector('td:nth-child(4)').textContent.replace('$', '');
                        row.querySelector('td:nth-child(5)').textContent =
                            `$${(price * quantity).toFixed(2)}`;
                    } else {
                        alert('Có lỗi xảy ra');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            };

            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.closest('tr').getAttribute('data-product-id');
                    const quantity = this.value;
                    updateQuantity(productId, quantity);
                });
            });

            document.querySelectorAll('.delete-item').forEach(button => {
                button.addEventListener('click', async function() {
                    const productId = this.closest('tr').getAttribute('data-product-id');
                    try {
                        const response = await fetch(
                            `{{ route('cart.destroy', '') }}/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });
                        const data = await response.json();
                        if (data.success) {
                            this.closest('tr').remove(); // Remove the row from the table
                            // If no items left, display empty cart message
                            if (document.querySelector('tbody').children.length === 0) {
                                document.querySelector('table').remove();
                                document.querySelector('p').textContent =
                                    'Giỏ hàng của bạn đang trống.';
                            }
                        } else {
                            alert('Có lỗi xảy ra');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection

@section('css')
    <style>
        .img-thumbnail {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 4px;
            background-color: #f8f9fa;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
