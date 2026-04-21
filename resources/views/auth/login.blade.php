<!DOCTYPE html>

<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sistem Peminjaman Barang - Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed-variant": "#374767",
                        "surface-container": "#151f37",
                        "surface-container-highest": "#2a344d",
                        "secondary-fixed": "#d8e2ff",
                        "secondary-container": "#374767",
                        "outline-variant": "#44474d",
                        "on-error": "#690005",
                        "inverse-primary": "#515f78",
                        "tertiary-fixed-dim": "#38debb",
                        "inverse-surface": "#d9e2ff",
                        "on-secondary-container": "#a5b5db",
                        "surface-bright": "#2f3952",
                        "on-surface": "#d9e2ff",
                        "surface-container-low": "#101b33",
                        "tertiary-container": "#001e17",
                        "on-tertiary-fixed-variant": "#005142",
                        "inverse-on-surface": "#263049",
                        "secondary": "#b6c6ed",
                        "tertiary-fixed": "#5ffbd6",
                        "background": "#08132a",
                        "on-secondary-fixed": "#091b39",
                        "secondary-fixed-dim": "#b6c6ed",
                        "on-tertiary-container": "#00937a",
                        "on-primary": "#233148",
                        "primary-fixed": "#d6e3ff",
                        "on-background": "#d9e2ff",
                        "on-error-container": "#ffdad6",
                        "surface-tint": "#b9c7e4",
                        "surface-container-high": "#1f2942",
                        "tertiary": "#38debb",
                        "on-primary-fixed": "#0d1c32",
                        "on-surface-variant": "#c5c6cd",
                        "primary-container": "#0a192f",
                        "outline": "#8f9097",
                        "on-primary-fixed-variant": "#39475f",
                        "surface-container-lowest": "#030d25",
                        "primary": "#b9c7e4",
                        "surface-dim": "#08132a",
                        "error": "#ffb4ab",
                        "on-secondary": "#20304f",
                        "surface-variant": "#2a344d",
                        "on-tertiary": "#00382d",
                        "primary-fixed-dim": "#b9c7e4",
                        "surface": "#08132a",
                        "error-container": "#93000a",
                        "on-primary-container": "#74829d",
                        "on-tertiary-fixed": "#002019"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "16px",
                        "margin": "40px",
                        "xl": "32px",
                        "xs": "8px",
                        "base": "4px",
                        "lg": "24px",
                        "sm": "12px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "h1": ["Inter"],
                        "body-lg": ["Inter"],
                        "h2": ["Inter"],
                        "body-md": ["Inter"],
                        "label-caps": ["Inter"],
                        "code": ["monospace"]
                    },
                    "fontSize": {
                        "h1": ["32px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "1.6",
                            "letterSpacing": "0",
                            "fontWeight": "400"
                        }],
                        "h2": ["24px", {
                            "lineHeight": "1.3",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "1.5",
                            "letterSpacing": "0",
                            "fontWeight": "400"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "1",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "code": ["13px", {
                            "lineHeight": "1.4",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glow-shadow {
            box-shadow: 0 20px 30px -10px rgba(17, 34, 64, 0.5);
        }

        body {
            background-color: #0A192F;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="font-body-md text-on-surface selection:bg-primary selection:text-on-primary">
    <header
        class="fixed top-0 left-0 right-0 z-50 bg-slate-950 dark:bg-[#0A192F] text-white dark:text-white border-b border-slate-800 dark:border-[#233554] flex justify-between items-center w-full px-6 py-3">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-white" data-icon="inventory_2">inventory_2</span>
            <span class="text-lg font-bold text-white tracking-tight font-h2">Sistem Peminjaman Barang</span>
        </div>
    </header>
    <main class="min-h-screen flex items-center justify-center pt-16 px-gutter bg-[#0A192F]">
        <div class="relative w-full max-w-[480px]">
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-tertiary/10 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-secondary/10 rounded-full blur-[80px]"></div>
            <div class="relative bg-[#112240] border border-[#233554] rounded-xl p-xl glow-shadow">
                <div class="flex flex-col items-center mb-xl">
                    <div
                        class="w-16 h-16 bg-[#1B2B48] border border-[#233554] rounded-full flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-white text-3xl"
                            data-icon="inventory_2">inventory_2</span>
                    </div>
                    <h1 class="font-h1 text-h1 text-white mb-xs">Selamat Datang</h1>
                    <p class="font-body-md text-on-surface-variant text-center">Silakan masuk untuk mengakses Sistem
                        Peminjaman Barang</p>
                </div>
                <form class="space-y-lg" action="{{ route('login') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-4 mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-red-400 text-sm"
                                    data-icon="error">error</span>
                                <span class="text-red-400 font-semibold text-sm">Login Gagal</span>
                            </div>
                            <ul class="text-red-300 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="space-y-xs">
                        <label class="font-label-caps text-label-caps text-on-surface-variant" for="email">EMAIL
                            ADDRESS</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-sm"
                                data-icon="mail">mail</span>
                            <input
                                class="w-full bg-[#112240] border border-[#233554] rounded-lg py-3 pl-12 pr-4 text-white placeholder:text-[#44474d] focus:outline-none focus:border-white focus:ring-1 focus:ring-white transition-all font-body-md"
                                id="email" name="email" placeholder="nama@institusi.ac.id" type="email"
                                value="{{ old('email') }}" required />
                        </div>
                    </div>
                    <div class="space-y-xs">
                        <div class="flex justify-between items-center">
                            <label class="font-label-caps text-label-caps text-on-surface-variant"
                                for="password">PASSWORD</label>
                        </div>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-sm"
                                data-icon="lock">lock</span>
                            <input
                                class="w-full bg-[#112240] border border-[#233554] rounded-lg py-3 pl-12 pr-4 text-white placeholder:text-[#44474d] focus:outline-none focus:border-white focus:ring-1 focus:ring-white transition-all font-body-md"
                                id="password" name="password" placeholder="••••••••" type="password" required />
                        </div>
                    </div>
                    <button
                        class="w-full bg-white text-[#0A192F] font-semibold py-3 rounded-lg hover:bg-[#f8f9fa] active:scale-[0.98] transition-all flex items-center justify-center gap-2 shadow-lg shadow-white/5"
                        type="submit">
                        <span>Masuk ke Sistem</span>
                        <span class="material-symbols-outlined text-lg" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </form>
            </div>
            <div class="mt-lg grid grid-cols-2 gap-4">
                <div class="bg-[#112240]/50 border border-[#233554]/50 rounded-lg p-md flex items-center gap-3">
                    <span class="material-symbols-outlined text-tertiary" data-icon="verified_user">verified_user</span>
                    <span class="text-xs text-on-surface-variant leading-tight">Institutional<br />Trust Security</span>
                </div>
                <div class="bg-[#112240]/50 border border-[#233554]/50 rounded-lg p-md flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary"
                        data-icon="support_agent">support_agent</span>
                    <span class="text-xs text-on-surface-variant leading-tight">24/7 Technical<br />Support
                        Access</span>
                </div>
            </div>
        </div>
    </main>
    <footer
        class="fixed bottom-0 left-0 right-0 z-50 bg-slate-950 dark:bg-[#0A192F] text-slate-400 dark:text-[#8892B0] border-t border-slate-800 dark:border-[#233554] flex flex-col md:flex-row justify-between items-center w-full px-8 py-6 gap-4 font-['Inter'] text-xs font-normal">
        <div>
            © 2024 Sistem Peminjaman Barang. Institutional Trust.
        </div>
        <div class="flex gap-6">
            <a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
            <a class="hover:text-white transition-colors" href="#">Terms of Service</a>
            <a class="hover:text-white transition-colors" href="#">Help Center</a>
        </div>
    </footer>
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute inset-0 bg-[#0A192F]"></div>
        <div
            class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary/5 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-tertiary/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2">
        </div>
    </div>
</body>

</html>
