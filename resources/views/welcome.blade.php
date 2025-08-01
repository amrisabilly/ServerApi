<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Artikel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold text-gray-800">Portal Artikel</h1>
            <p class="text-gray-600 mt-2">Kumpulan artikel terbaru dan terpercaya</p>
        </div>
    </header>

    <!-- Featured Articles -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Artikel Unggulan</h2>
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @foreach ($data['featured'] as $featuredId)
                @foreach ($data['categories'] as $categoryName => $articles)
                    @foreach ($articles as $article)
                        @if ($article['id'] == $featuredId)
                            <a href="{{ route('artikel.detail', $article['id']) }}"
                                class="block transform hover:scale-105 transition duration-300">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
                                    <img src="/images/{{ $article['image'] }}" alt="{{ $article['title'] }}"
                                        class="w-full h-48 object-cover 
                                         @if ($categoryName == 'teknologi') bg-blue-200 
                                         @elseif($categoryName == 'bisnis') bg-green-200 
                                         @else bg-red-200 @endif">
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold mb-2">{{ $article['title'] }}</h3>
                                        <p class="text-gray-600 text-sm mb-2">Oleh {{ $article['author'] }} •
                                            {{ date('d M Y', strtotime($article['date'])) }}</p>
                                        <p class="text-gray-700 mb-4">{{ $article['content'] }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($article['tags'] as $tag)
                                                <span
                                                    class="
                                                @if ($categoryName == 'teknologi') bg-blue-100 text-blue-800 
                                                @elseif($categoryName == 'bisnis') bg-green-100 text-green-800 
                                                @else bg-red-100 text-red-800 @endif
                                                px-2 py-1 rounded text-xs">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </section>

    <!-- Categories -->
    <section class="container mx-auto px-4 py-8">
        @foreach ($data['categories'] as $categoryName => $articles)
            <div class="mb-12">
                <h2
                    class="text-2xl font-bold text-gray-800 mb-6 border-l-4 
                    @if ($categoryName == 'teknologi') border-blue-500 
                    @elseif($categoryName == 'bisnis') border-green-500 
                    @else border-red-500 @endif pl-4">
                    {{ ucfirst($categoryName) }}</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($articles as $article)
                        @if (!in_array($article['id'], $data['featured']))
                            <a href="{{ route('artikel.detail', $article['id']) }}"
                                class="block transform hover:scale-105 transition duration-300">
                                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg">
                                    <h3 class="text-xl font-semibold mb-2">{{ $article['title'] }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">Oleh {{ $article['author'] }} •
                                        {{ date('d M Y', strtotime($article['date'])) }}</p>
                                    <p class="text-gray-700 mb-4">{{ $article['content'] }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($article['tags'] as $tag)
                                            <span
                                                class="
                                            @if ($categoryName == 'teknologi') bg-purple-100 text-purple-800 
                                            @elseif($categoryName == 'bisnis') bg-yellow-100 text-yellow-800 
                                            @else bg-pink-100 text-pink-800 @endif
                                            px-2 py-1 rounded text-xs">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Portal Artikel. Total artikel: {{ $data['totalArticles'] }} | Terakhir diperbarui:
                {{ date('d M Y', strtotime($data['lastUpdated'])) }}</p>
        </div>
    </footer>
</body>

</html>
<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">
        <p>&copy; 2024 Portal Artikel. Total artikel: 5 | Terakhir diperbarui: 15 Jan 2024</p>
    </div>
</footer>
</body>

</html>
