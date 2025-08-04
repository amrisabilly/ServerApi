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
                            <a href="{{ route('artikel.show', ['slug' => Str::slug($article['title'])]) }}"
                                class="block transform hover:scale-105 transition duration-300">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
                                    <img src="/artikel/{{ $article['image'] }}" alt="{{ $article['title'] }}"
                                        class="w-full h-48 object-cover 
                                         @if ($categoryName == 'teknologi') bg-blue-200 
                                         @elseif($categoryName == 'bisnis') bg-green-200 
                                         @else bg-red-200 @endif ">
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold mb-2">{{ $article['title'] }}</h3>
                                        <p class="text-gray-600 text-sm mb-2">Oleh {{ $article['author'] }} •
                                            {{ date('d M Y', strtotime($article['date'])) }}</p>
                                        <p class="text-gray-700 mb-4">{{ Str::limit($article['content'], 100) }}</p>
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
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($data['categories'] as $category => $articles)
                @foreach ($articles as $article)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/artikel/{{ $article['image'] }}" alt="{{ $article['title'] }}"
                            class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-2">{{ $article['title'] }}</h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($article['content'], 100) }}</p>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-sm text-gray-500">{{ $article['author'] }}</span>
                                <span class="text-sm text-gray-500">{{ date('d M Y', strtotime($article['date'])) }}</span>
                            </div>
                            <a href="{{ route('artikel.show', ['slug' => Str::slug($article['title'])]) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Portal Artikel. Total artikel: {{ $data['totalArticles'] ?? count(collect($data['categories'])->flatten(1)) }} | Terakhir diperbarui:
                {{ date('d M Y') }}</p>
        </div>
    </footer>
</body>

</html>