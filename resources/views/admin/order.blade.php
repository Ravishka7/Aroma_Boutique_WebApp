<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .font_size{
            text-align: center;
            font-size: 40px;
            padding-top: 40px;
        }

        .center{
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 40px;
            border: 3px solid white;
        }

        .th_color{
            background-color: #4CAF50;
            color: white;
        }

        th,td{
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session()->get('message')}}
                </div>
            @endif

            <h1 class="font_size">All Orders</h1>

                <div>

                    <form action="{{url('search')}}" method="get">
                        	@csrf
                        <input type="text" style="color: black" name="search" placeholder="Search">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </form>

                </div>

            <table class="center">

                <tr class="th_color">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product_title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>Downlaod PDF</th>
                </tr>

                @forelse($order as $order)

                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>

                    <td>
                        <img src="/product/{{$order->image}}" alt="" width="100px" height="100px">
                    </td>
                    <td>
                        @if($order->delivery_status == 'pending')
                        <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Confirm Delivery?')" class="btn btn-primary">Delivered</a>
                        @else
                            <p style="color: greenyellow">Delivered</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('download_pdf', $order->id) }}" class="btn btn-secondary">Download PDF</a>
                    </td>
                </tr>

                    @empty
                    <tr>
                        <td colspan="16">No Order Found</td>
                    </tr>

                @endforelse
            </table>

        </div>

    </div>
    <!-- container-scroller -->
</div>
<!-- plugins:js -->
@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>
