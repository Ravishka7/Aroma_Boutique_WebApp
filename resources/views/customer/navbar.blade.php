<!--Nav-->
<nav id="header" class="w-full z-30 top-0 py-1">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

        <label for="menu-toggle" class="cursor-pointer md:hidden block">
            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">

                    <li><a href="{{ route('wperfume') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Women's Perfume</a></li>
                    <li><a href="{{ route('mperfume') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 ml-4">Men's Cologne</a></li>
                    <li> <a href="{{url('show_order')}}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 ml-4">
                            My Orders
                        </a></li>
                </ul>

            </nav>
        </div>

        <div class="order-1 md:order-2">
            <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{route('customer.dashboard')}}" style="margin-right: 220px">
                <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                </svg>
                ÁROMA BOUTIQUE
            </a>
        </div>

        <div class="order-2 md:order-3 flex items-center" id="nav-content">



            <a class="pl-3 inline-block no-underline hover:text-black" href="{{ route('show_cart') }}">
                @auth

                    <li>
                        <a class="nav-link"  href="{{url('show_cart')}}">Cart [ <span style="color: green;">{{App\Models\cart::where('user_id','=',Auth::user()->id)->count()}}]</span></a>
                    </li>

                @else

                    <li>
                        <a class="nav-link"  href="{{url('show_cart')}}">Cart </a>
                    </li>


                @endauth


            </a>


            <a class="pl-3 inline-block no-underline hover:text-black" href="{{ route('dashboard') }}" style="margin-left: 15px">
                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M4 18H6V20H18V4H6V6H4V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V18ZM6 11H13V13H6V16L1 12L6 8V11Z"></path></svg>
            </a>


        </div>
    </div>
</nav>
