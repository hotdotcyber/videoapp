<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moving & Transport Services</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class=" bg-gray-100">
    
    <header class=" flex flex-col md:flex-row items-center justify-between bg-black text-white p-6 text-center text-2xl font-bold">
        <img  class=" w-80 md:w-40 m-4" src="logo.png">
        <h1 class="p-4"> Reliable Moving & Transport Services Call 0722543212</h1>
        <a class="bg-blue-600 rounded-lg p-4" href="tel:+254 722 543 212">Call Now</a>
    </header>
    
    <section class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-800">Effortless Moving & Transport</h1>
        <p class="text-gray-600 mt-4 max-w-2xl mx-auto">We offer professional moving services for homes and businesses, ensuring a hassle-free experience.</p>
        <a href="#contact" class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700">Get a Quote</a>
    </section>


    
    <section class="bg-white py-12 px-6 md:px-20">
        <h2 class="text-3xl font-bold text-center text-gray-800">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col items-center relative">
                <span class="text-4xl">🚛</span>
                <h3 class="text-xl font-bold mt-2">Residential Moving</h3>
                <p class="mt-2 text-gray-600">We ensure safe and quick home relocations.</p>
                <span class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 text-sm rounded-full">10% Off</span>
            </div>
            <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col items-center relative">
                <span class="text-4xl">🏢</span>
                <h3 class="text-xl font-bold mt-2">Office Relocation</h3>
                <p class="mt-2 text-gray-600">Minimal downtime, maximum efficiency for office moves.</p>
                <span class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 text-sm rounded-full">Limited Offer</span>
            </div>
            <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col items-center relative">
                <span class="text-4xl">📦</span>
                <h3 class="text-xl font-bold mt-2">Logistics & Transport</h3>
                <p class="mt-2 text-gray-600">Reliable goods transport across different locations.</p>
                <span class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 text-sm rounded-full">Special Discount</span>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="max-w-lg mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif
    
    <section id="contact" class="py-12 px-6 bg-gray-100">
        <h2 class="text-3xl font-bold text-center text-gray-800">Get a Quote</h2>
        <form action="/send-email" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <label class="block text-gray-700">Full Name</label>
    <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Your Name" required>
    
    <label class="block text-gray-700 mt-4">Email</label>
    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Your Email" required>
    
    <label class="block text-gray-700 mt-4">Phone Number</label>
    <input type="tel" name="phone" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Your Phone Number" required>
    
    <label class="block text-gray-700 mt-4">Message</label>
    <textarea name="message" class="w-full p-2 border border-gray-300 rounded mt-2" rows="4" placeholder="Your Message" required></textarea>
    
    <button type="submit" class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700">Submit</button>
</form>

    </section>
    
    <footer class="bg-blue-600 text-white text-center py-4 mt-12">
        &copy; 2025 Moving & Transport Services. All Rights Reserved.
    </footer>
</body>
</html>
