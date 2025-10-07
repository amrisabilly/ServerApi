@extends('landing.layout.app')

@section('style')
    <style>
        /* popup sederhana */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
        }

        .reply-form {
            margin-top: 10px;
            background: #f9fafb;
            border-radius: 8px;
            padding: 12px;
        }

        .reply-list {
            margin-left: 2rem;
            margin-top: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Artikel -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>
        <p class="text-sm text-gray-500 mb-6">✍️ {{ $article->author ?? 'Anonim' }} •
            {{ $article->created_at->format('d M Y') }}</p>
        <div class="prose max-w-none mb-10">
            {!! nl2br(e($article->content)) !!}
        </div>

        <!-- Tombol komentar -->
        <button onclick="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Tambah Komentar
        </button>

        <!-- Daftar komentar -->
        <h2 class="text-2xl font-semibold mt-10 mb-4">Komentar</h2>
        <div id="comment-list" class="space-y-4">
            @forelse ($article->comments as $comment)
                <div class="p-4 bg-gray-100 rounded-lg" data-comment-id="{{ $comment->id }}">
                    <p class="font-semibold text-gray-800">{{ $comment->name }}</p>
                    <p class="text-gray-700">{{ $comment->comment }}</p>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    <button class="text-blue-600 text-sm mt-2 reply-btn"
                        data-comment-id="{{ $comment->id }}">Balas</button>
                    <!-- Tempat reply form akan muncul -->
                    <div class="reply-form-container"></div>
                    <!-- Daftar reply -->
                    @if ($comment->replies && $comment->replies->count())
                        <div class="reply-list">
                            @foreach ($comment->replies as $reply)
                                <div class="p-3 bg-white rounded-lg border mb-2">
                                    <p class="font-semibold text-gray-800">{{ $reply->name }}</p>
                                    <p class="text-gray-700">{{ $reply->comment }}</p>
                                    <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>

    <!-- Modal Form Komentar -->
    <div id="commentModal" class="modal">
        <div class="modal-content">
            <h2 class="text-xl font-semibold mb-4">Tulis Komentar</h2>
            <form id="commentForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1">Komentar</label>
                    <textarea name="comment" rows="3" class="w-full border rounded p-2" required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()"
                        class="px-3 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Buka & tutup modal
        function openModal() {
            document.getElementById('commentModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('commentModal').style.display = 'none';
        }

        // Ambil token dari meta tag, aman jika meta tidak ada
        function getCsrfToken() {
            var meta = document.querySelector('meta[name="csrf-token"]');
            return meta ? meta.getAttribute('content') : '';
        }

        // Handle form submit pakai AJAX
        document.getElementById('commentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('comments.store') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let commentList = document.getElementById('comment-list');
                        // Hapus pesan "Belum ada komentar." jika ada
                        let emptyMsg = commentList.querySelector('p.text-gray-500');
                        if (emptyMsg) emptyMsg.remove();

                        let newComment = `
                            <div class="p-4 bg-gray-100 rounded-lg" data-comment-id="${data.comment.id}">
                                <p class="font-semibold text-gray-800">${data.comment.name}</p>
                                <p class="text-gray-700">${data.comment.comment}</p>
                                <p class="text-xs text-gray-500">${data.comment.created_at ?? 'baru saja'}</p>
                                <button class="text-blue-600 text-sm mt-2 reply-btn" data-comment-id="${data.comment.id}">Balas</button>
                                <!-- Tempat reply form akan muncul -->
                                <div class="reply-form-container"></div>
                            </div>
                        `;
                        commentList.insertAdjacentHTML('afterbegin', newComment);
                        closeModal();
                        document.getElementById('commentForm').reset();
                        // Tambahkan event listener untuk tombol balas yang baru ditambahkan
                        addReplyButtonListener(commentList.querySelector('div[data-comment-id]'));
                    }
                })
                .catch(err => console.error(err));
        });

        // Reply button logic
        document.querySelectorAll('.reply-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove any existing reply form
                document.querySelectorAll('.reply-form-container').forEach(c => c.innerHTML = '');
                // Insert reply form
                let commentId = this.getAttribute('data-comment-id');
                let container = this.parentElement.querySelector('.reply-form-container');
                container.innerHTML = `
                    <form class="reply-form" data-parent-id="${commentId}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <input type="hidden" name="parent_id" value="${commentId}">
                        <div class="mb-2">
                            <input type="text" name="name" class="w-full border rounded p-2" placeholder="Nama" required>
                        </div>
                        <div class="mb-2">
                            <textarea name="comment" rows="2" class="w-full border rounded p-2" placeholder="Tulis balasan..." required></textarea>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" class="cancel-reply px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim</button>
                        </div>
                    </form>
                `;
                // Cancel reply
                container.querySelector('.cancel-reply').onclick = function() {
                    container.innerHTML = '';
                };
                // Handle reply submit
                container.querySelector('form').onsubmit = function(e) {
                    e.preventDefault();
                    let formData = new FormData(this);
                    fetch("{{ route('comments.reply') }}", {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let replyHtml = `
                                <div class="p-3 bg-white rounded-lg border mb-2">
                                    <p class="font-semibold text-gray-800">${data.comment.name}</p>
                                    <p class="text-gray-700">${data.comment.comment}</p>
                                    <p class="text-xs text-gray-500">${data.comment.created_at ?? 'baru saja'}</p>
                                </div>
                            `;
                                // Cari atau buat reply-list
                                let parentDiv = container.parentElement;
                                let replyList = parentDiv.querySelector('.reply-list');
                                if (!replyList) {
                                    replyList = document.createElement('div');
                                    replyList.className = 'reply-list';
                                    parentDiv.appendChild(replyList);
                                }
                                replyList.insertAdjacentHTML('beforeend', replyHtml);
                                container.innerHTML = '';
                            }
                        })
                        .catch(err => console.error(err));
                };
            });
        });

        // Fungsi untuk menambahkan event listener pada tombol balas
        function addReplyButtonListener(commentElement) {
            let replyButton = commentElement.querySelector('.reply-btn');
            if (replyButton) {
                replyButton.addEventListener('click', function() {
                    // Logika untuk menampilkan form balasan
                    document.querySelectorAll('.reply-form-container').forEach(c => c.innerHTML = '');
                    let commentId = this.getAttribute('data-comment-id');
                    let container = this.parentElement.querySelector('.reply-form-container');
                    container.innerHTML = `
                        <form class="reply-form" data-parent-id="${commentId}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="parent_id" value="${commentId}">
                            <div class="mb-2">
                                <input type="text" name="name" class="w-full border rounded p-2" placeholder="Nama" required>
                            </div>
                            <div class="mb-2">
                                <textarea name="comment" rows="2" class="w-full border rounded p-2" placeholder="Tulis balasan..." required></textarea>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" class="cancel-reply px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim</button>
                            </div>
                        </form>
                    `;
                    // Cancel reply
                    container.querySelector('.cancel-reply').onclick = function() {
                        container.innerHTML = '';
                    };
                    // Handle reply submit
                    container.querySelector('form').onsubmit = function(e) {
                        e.preventDefault();
                        let formData = new FormData(this);
                        fetch("{{ route('comments.reply') }}", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    let replyHtml = `
                                    <div class="p-3 bg-white rounded-lg border mb-2">
                                        <p class="font-semibold text-gray-800">${data.comment.name}</p>
                                        <p class="text-gray-700">${data.comment.comment}</p>
                                        <p class="text-xs text-gray-500">${data.comment.created_at ?? 'baru saja'}</p>
                                    </div>
                                `;
                                    // Cari atau buat reply-list
                                    let parentDiv = container.parentElement;
                                    let replyList = parentDiv.querySelector('.reply-list');
                                    if (!replyList) {
                                        replyList = document.createElement('div');
                                        replyList.className = 'reply-list';
                                        parentDiv.appendChild(replyList);
                                    }
                                    replyList.insertAdjacentHTML('beforeend', replyHtml);
                                    container.innerHTML = '';
                                }
                            })
                            .catch(err => console.error(err));
                    };
                });
            }
        }

        // Tambahkan listener untuk komentar yang sudah ada
        document.querySelectorAll('#comment-list > div').forEach(commentElement => {
            addReplyButtonListener(commentElement);
        });
    </script>
@endsection
