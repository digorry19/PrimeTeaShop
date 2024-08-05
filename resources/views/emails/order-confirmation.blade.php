<h2>Chi tiết đơn hàng</h2>

<p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
<p><strong>Tổng số tiền:</strong> ${{ $order->total_amount }}</p>

<h3>Danh sách sản phẩm</h3>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng</th>
        </tr>
    </thead>
    <tbody>
        @if($order && $order->items && $order->items->count())
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                    <td>${{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">Không có sản phẩm trong đơn hàng.</td>
            </tr>
        @endif
    </tbody>
</table>

<p>Địa chỉ giao hàng: {{ $order->address }}</p>
<p>Trân trọng,</p>
<p>Đội ngũ của chúng tôi</p>
