<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article['title'] }} - Portal Artikel</title>
    @vite('resources/css/app.css')

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $article['title'] }}">
    <meta property="og:description" content="{{ Str::limit($article['content'], 100) }}">
    <meta property="og:image" content="{{ asset('images/' . $article['image']) }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <nav class="mb-4">
                <a href="/" class="text-blue-600 hover:text-blue-800">← Kembali ke Beranda</a>
            </nav>
            <h1 class="text-4xl font-bold text-gray-800">{{ $article['title'] }}</h1>
            <div class="flex items-center mt-4 text-gray-600">
                <span class="mr-4">Oleh {{ $article['author'] }}</span>
                <span class="mr-4">{{ date('d M Y', strtotime($article['date'])) }}</span>
                <span
                    class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ ucfirst($article['category']) }}</span>
            </div>
        </div>
    </header>

    <!-- Article Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/artikel/{{ $article['image'] }}" alt="{{ $article['title'] }}"
                    class="w-full h-64 object-cover bg-gray-200">

                <div class="p-8">
                    <div class="prose max-w-none">
                        <p class="text-lg leading-relaxed text-gray-700 mb-6">{{ $article['content'] }}</p>

                        <!-- Extended content for demonstration -->
                        <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                        <p class="text-gray-700 mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                            in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>

                    <!-- Tags -->
                    <div class="border-t pt-6 mt-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-3">Tags:</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($article['tags'] as $tag)
                                        <span
                                            class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Share Button -->
                            <button id="shareBtn"
                                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                    </path>
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Share Modal -->
    <div id="shareModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 w-80 mx-4 relative">
            <!-- Close Button -->
            <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- Modal Header -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Share</h2>

            <!-- Share Text -->
            <p class="text-gray-600 mb-6">Share this link via</p>

            <!-- Social Media Icons -->
            <div class="flex justify-center gap-4 mb-8">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article['title']) }}"
                    target="_blank"
                    class="w-12 h-12 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition duration-200">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/" target="_blank"
                    class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition duration-200">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.349-1.051-2.349-2.348s1.051-2.349 2.349-2.349 2.348 1.052 2.348 2.349-1.051 2.348-2.348 2.348zm7.718 0c-1.297 0-2.349-1.051-2.349-2.348s1.052-2.349 2.349-2.349c1.296 0 2.348 1.052 2.348 2.349s-1.052 2.348-2.348 2.348z" />
                    </svg>
                </a>
                <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}" target="_blank"
                    class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition duration-200">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                    </svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                    target="_blank"
                    class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article['title']) }}"
                    target="_blank"
                    class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center hover:bg-blue-600 transition duration-200">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                    </svg>
                </a>
            </div>

            <!-- Copy Link Section -->
            <div>
                <p class="text-gray-600 mb-3">Or copy link</p>
                <div class="flex items-center bg-gray-50 rounded-lg border">
                    <div class="flex items-center px-3 py-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <input type="text" id="linkInput" value="{{ request()->fullUrl() }}"
                        class="flex-1 bg-transparent px-2 py-2 text-sm text-gray-700 outline-none" readonly>
                    <button id="copyBtn"
                        class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-r-lg text-sm font-medium transition duration-200">
                        Copy
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Share Modal Functionality
        const shareBtn = document.getElementById('shareBtn');
        const shareModal = document.getElementById('shareModal');
        const closeModal = document.getElementById('closeModal');
        const copyBtn = document.getElementById('copyBtn');
        const linkInput = document.getElementById('linkInput');

        // Open modal
        shareBtn.addEventListener('click', () => {
            shareModal.classList.remove('hidden');
            shareModal.classList.add('flex');
        });

        // Close modal
        closeModal.addEventListener('click', () => {
            shareModal.classList.add('hidden');
            shareModal.classList.remove('flex');
        });

        // Close modal when clicking outside
        shareModal.addEventListener('click', (e) => {
            if (e.target === shareModal) {
                shareModal.classList.add('hidden');
                shareModal.classList.remove('flex');
            }
        });

        // Copy link functionality
        copyBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(linkInput.value);
                copyBtn.textContent = 'Copied!';
                copyBtn.classList.add('bg-green-600');
                copyBtn.classList.remove('bg-teal-600');

                setTimeout(() => {
                    copyBtn.textContent = 'Copy';
                    copyBtn.classList.remove('bg-green-600');
                    copyBtn.classList.add('bg-teal-600');
                }, 2000);
            } catch (err) {
                // Fallback for older browsers
                linkInput.select();
                document.execCommand('copy');
                copyBtn.textContent = 'Copied!';

                setTimeout(() => {
                    copyBtn.textContent = 'Copy';
                }, 2000);
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                shareModal.classList.add('hidden');
                shareModal.classList.remove('flex');
            }
        });
    </script>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Portal Artikel</p>
        </div>
    </footer>
</body>

</html>
