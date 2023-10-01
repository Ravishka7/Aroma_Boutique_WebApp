<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Login Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>
</head>
<body class="bg-white font-family-karla h-screen">

<div class="w-full flex flex-wrap">

    <!-- Login Section -->
    <div class="w-full md:w-1/2 flex flex-col">

        <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
            <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="{{route('customer.dashboard')}}" style="margin-right: 80px">
                <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                </svg>
                ÁROMA BOUTIQUE
            </a>
        </div>


        <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
            <p class="text-center text-3xl">REGISTER</p>

            <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="flex flex-col pt-4">
                    <label class="text-lg" for="name" value="{{ __('Name') }}">Name</label>
                    <input type="text" id="name" name="name" placeholder="Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" :value="old('name')" required autofocus autocomplete="name">
                </div>

                <div class="flex flex-col pt-4">
                    <label for="email" class="text-lg" value="{{ __('Email') }}">Email</label>
                    <input type="email" id="email" name="email" placeholder="user@example.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" :value="old('email')" required autocomplete="username">
                </div>

                <div class="flex flex-col pt-4">
                    <label for="phone" class="text-lg" value="{{ __('phone') }}">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="0771234567" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" :value="old('phone')" required autocomplete="username">
                </div>

                <div class="flex flex-col pt-4">
                    <label for="address" class="text-lg" value="{{ __('address') }}">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" :value="old('address')" required autocomplete="username">
                </div>

                <div class="flex flex-col pt-4">
                    <label for="password" class="text-lg" value="{{ __('Password') }}">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" required autocomplete="new-password">
                </div>

                <div class="flex flex-col pt-4">
                    <label for="password_confirmation" class="text-lg" value="{{ __('Password') }}">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-enter yourPassword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" required autocomplete="new-password">
                </div>

                <x-button type="submit" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">
                    {{ __('Register') }}
                </x-button>
            </form>
            <div class="text-center pt-12 pb-12">
                <p>Already Registered? <a href="{{ route('login') }}" class="underline font-semibold">Login To Your Account.</a></p>
            </div>
        </div>

    </div>

    <!-- Image Section -->
    <div class="w-1/2 shadow-2xl">
        <img class="object-cover w-full h-screen hidden md:block" src="https://images.unsplash.com/photo-1622618991746-fe6004db3a47?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80">
    </div>
</div>

</body>
</html>
