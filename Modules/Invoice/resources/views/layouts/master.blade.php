<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="flex min-h-screen bg-muted/40">
    <aside class="fixed inset-y-0 left-0 z-10 hidden w-14 flex-col border-r bg-background sm:flex">
        <nav class="flex flex-col items-center gap-4 px-2 sm:py-5">
            <a href="#" class="group flex h-9 w-9 items-center justify-center gap-2 rounded-full bg-primary text-lg font-semibold text-primary-foreground">
                <span class="sr-only">Acme Inc</span>
                <!-- Use FontAwesome or any icon library -->
                <i class="fa fa-box"></i>
            </a>
            <!-- Add more nav items with tooltips -->
            <!-- Example Nav Item -->
            <a href="#" class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground hover:text-foreground">
                <i class="fa fa-home"></i>
                <span class="sr-only">Dashboard</span>
            </a>
        </nav>
    </aside>

    <div class="flex flex-col sm:gap-4 sm:py-4 sm:pl-14 w-full">
        <header class="sticky top-0 z-30 flex h-14 items-center gap-4 border-b bg-background px-4 sm:static sm:h-auto sm:border-0 sm:bg-transparent sm:px-6">
            <!-- Include breadcrumb and other header items here -->
            <form class="relative ml-auto flex-1 md:grow-0">
                <input type="search" placeholder="Search invoices..." class="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[336px]">
            </form>
            <!-- User dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline">
                    <img src="/placeholder.svg" class="rounded-full" width="36" height="36" alt="Avatar">
                </button>
                <div class="dropdown-content">
                    <a href="#">Settings</a>
                    <a href="#">Support</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </header>

        <main class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
