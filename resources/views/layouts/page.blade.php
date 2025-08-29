<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <header>
        <flux:navbar>
            <flux:nav-item href="{{ route('home') }}">Home</flux:nav-item>
            <flux:nav-item href="{{ route('categories.show', ['category' => 'coffee']) }}">Coffee</flux:nav-item>
            <flux:nav-item href="{{ route('categories.show', ['category' => 'tea']) }}">Tea</flux:nav-item>
            <flux:nav-item href="{{ route('dashboard') }}">Dashboard</flux:nav-item>
        </flux:navbar>
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>