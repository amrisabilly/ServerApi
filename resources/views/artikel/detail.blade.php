<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article['title'] }} - Portal Artikel</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ route('artikel.show', ['slug' => Str::slug($article['title'])]) }}">

    <!-- Open Graph Meta Tags untuk Facebook & LinkedIn -->
    <meta property="og:title" content="{{ $article['title'] }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($article['content']), 160) }}">
    <meta property="og:image" content="{{ url('artikel/' . $article['image']) }}">
    <meta property="og:image:secure_url" content="{{ url('artikel/' . $article['image']) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:url" content="{{ route('artikel.show', ['slug' => Str::slug($article['title'])]) }}">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Portal Artikel">
    <meta property="article:author" content="{{ $article['author'] }}">
    <meta property="article:published_time" content="{{ $article['date'] }}">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $article['title'] }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($article['content']), 160) }}">
    <meta name="twitter:image" content="{{ asset('artikel/' . $article['image']) }}">
    <meta name="twitter:url" content="{{ route('artikel.show', ['slug' => Str::slug($article['title'])]) }}">
    <meta name="twitter:creator" content="@portalArtikel">

    <!-- Additional Meta Tags -->
    <meta name="description" content="{{ Str::limit(strip_tags($article['content']), 160) }}">
    <meta name="keywords" content="{{ implode(', ', $article['tags']) }}">

    <style>
        /* Custom styles for Laravel Share buttons */
        .share-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .share-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: transform 0.2s, opacity 0.2s;
        }

        .share-button:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }

        .share-button i {
            font-size: 1.5rem;
        }

        /* Social media specific colors */
        .facebook {
            background-color: #1877F2;
        }

        .twitter {
            background-color: #1DA1F2;
        }

        .linkedin {
            background-color: #0A66C2;
        }

        .whatsapp {
            background-color: #25D366;
        }

        .telegram {
            background-color: #0088CC;
        }
    </style>
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
            <p class="text-gray-600 mb-6">Share link</p>

            <!-- Social Media Icons dengan Laravel Share Raw Links -->
            <div class="share-buttons mb-8">
                @if (isset($shareButtons['facebook']))
                    <a href="{{ $shareButtons['facebook'] }}" target="_blank" class="share-button facebook"
                        title="Share ke Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif

                @if (isset($shareButtons['twitter']))
                    <a href="{{ $shareButtons['twitter'] }}" target="_blank" class="share-button twitter"
                        title="Share ke Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                @endif

                @if (isset($shareButtons['linkedin']))
                    <a href="{{ $shareButtons['linkedin'] }}" target="_blank" class="share-button linkedin"
                        title="Share ke LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                @endif

                @if (isset($shareButtons['whatsapp']))
                    <a href="{{ $shareButtons['whatsapp'] }}" target="_blank" class="share-button whatsapp"
                        title="Share ke WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                @endif

                @if (isset($shareButtons['telegram']))
                    <a href="{{ $shareButtons['telegram'] }}" target="_blank" class="share-button telegram"
                        title="Share ke Telegram">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                @endif
            </div>
            <!-- Copy Link Section -->
            <div>
                <p class="text-gray-600 mb-3">copy link</p>
                <div class="flex items-center bg-gray-50 rounded-lg border">
                    <div class="flex items-center px-3 py-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <input type="text" id="linkInput"
                        value="{{ route('artikel.show', ['slug' => Str::slug($article['title'])]) }}"
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
