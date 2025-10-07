<nav class="bg-slate-200 w-full h-20 flex justify-between items-center px-20">
    <h1>Logo</h1>
    <ul class="flex gap-10">
        <li><a href="{{ route('index') }}" class="{{ Request::is('/') ? 'border-b-2 border-cyan-500' : '' }}">Home</a>
        </li>
        <li><a href="{{ route('about') }}"
                class="{{ Request::is('about') ? 'border-b-2 border-cyan-500' : '' }}">about</a></li>
        <li><a href="{{ route('article') }}"
                class="{{ Request::is('article') ? 'border-b-2 border-cyan-500' : '' }}">article</a></li>
    </ul>
    <h1>Login</h1>
</nav>
