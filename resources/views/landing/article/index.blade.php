@extends('landing.layout.app')

@section('style')
@endsection

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($articles as $article)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="p-6 flex flex-col h-full">
                    <h2 class="text-xl font-bold mb-2 text-gray-800">
                        {{ $article->title }}
                    </h2>
                    <p class="text-gray-600 flex-grow line-clamp-3">
                        {{ Str::limit($article->content, 120) }}
                    </p>
                    <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                        <span>✍️ {{ $article->author ?? 'Anonim' }}</span>
                        <a href="{{ route('article.show', $article->id) }}"
                           class="text-blue-600 hover:underline font-medium">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
@endsection
