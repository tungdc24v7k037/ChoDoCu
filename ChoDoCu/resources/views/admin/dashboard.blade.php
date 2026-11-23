<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChoDoCu Admin — Demo UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
    tailwind.config = {
        darkMode: 'class'
    }
    </script>
    <style>
    body {
        font-family: Inter, ui-sans-serif, system-ui, sans-serif
    }

    .nav-active {
        background: #eef2ff;
        color: #465fff
    }

    .dark .nav-active {
        background: #26345a;
        color: #a5b4fc
    }

    .card {
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        background: white
    }

    .dark .card {
        background: #1c2434;
        border-color: #344054
    }

    .dark body {
        background: #101828
    }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-800 dark:bg-[#101828] dark:text-slate-100">
    <div class="min-h-screen flex" id="app">
        <aside id="sidebar"
            class="fixed z-30 inset-y-0 left-0 w-64 bg-white dark:bg-[#1c2434] border-r border-slate-200 dark:border-slate-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 overflow-y-auto">
            <div class="h-[72px] flex items-center px-5 gap-3 border-b border-slate-100 dark:border-slate-700">
                <div class="bg-indigo-600 text-white font-bold rounded-xl p-2">CĐC</div>
                <div class="font-bold text-xl">ChoDoCu <span class="text-indigo-600">Admin</span></div>
            </div>
            <div class="px-4 pt-6 pb-3 text-xs uppercase tracking-widest text-slate-400">Quản trị</div>
            <nav class="px-3 space-y-1" id="nav"><button data-page="dashboard"
                    class="nav-item nav-active w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm font-semibold"><span>▦</span>
                    Tổng quan</button><button data-page="listings"
                    class="nav-item w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm"><span>▤</span> Tin
                    đăng</button><button data-page="users"
                    class="nav-item w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm"><span>♙</span> Người
                    dùng</button><button data-page="categories"
                    class="nav-item w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm"><span>▧</span> Danh
                    mục</button><button data-page="reports"
                    class="nav-item w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm"><span>⚑</span> Báo cáo
                    vi phạm</button><button data-page="notifications"
                    class="nav-item w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm"><span>♧</span> Thông
                    báo</button><button data-page="settings"
                    class="nav-item w-full flex gap-3 items-center px-4 py-3 rounded-xl text-sm"><span>⚙</span> Cài
                    đặt</button></nav>
            <div class="mx-4 mt-10 p-4 rounded-xl bg-indigo-50 dark:bg-slate-800 text-sm">
                <b>Quản trị hệ thống</b>
                <p class="text-slate-500 dark:text-slate-400 mt-1">
                    Xin chào, {{ auth()->user()->name }}
                </p>
            </div>
        </aside>
        <div class="flex-1 lg:ml-64 min-w-0">
            <header
                class="sticky top-0 z-20 h-[72px] bg-white dark:bg-[#1c2434] border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-5 lg:px-8">
                <div class="flex gap-4 items-center"><button id="menuBtn"
                        class="rounded-xl border border-slate-200 dark:border-slate-600 px-3 py-2">☰</button>
                    <div
                        class="hidden md:flex items-center border border-slate-200 dark:border-slate-600 rounded-xl px-4 py-2 text-sm text-slate-400 w-72">
                        ⌕ <input class="ml-2 bg-transparent outline-none w-full" placeholder="Tìm kiếm chức năng..."
                            id="searchNav"></div>
                </div>
                <div class="flex gap-3 items-center"><button id="themeBtn"
                        class="rounded-xl border border-slate-200 dark:border-slate-600 px-3 py-2"
                        title="Sáng / tối">☾</button><span
                        class="rounded-full bg-indigo-100 text-indigo-700 font-bold w-9 h-9 grid place-items-center">AD</span><span
                        class="hidden sm:block text-sm font-semibold">{{ auth()->user()->name }}</span></div>
            </header>
            <main class="p-5 lg:p-8 max-w-[1600px] mx-auto">
                <div class="flex flex-wrap justify-between items-center gap-2 mb-6">
                    <div>
                        <h1 id="pageTitle" class="text-2xl font-bold">Tổng quan hệ thống</h1>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">ChoDoCu / Trang quản trị / <span
                                id="breadcrumb">Tổng quan</span></p>
                    </div>
                    <div class="text-sm border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2">
                        📅 Dữ liệu năm {{ $year }}
                    </div>
                </div>

                <section id="dashboard" class="page">

                    <!-- 4 thẻ thống kê -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-5">

                        <!-- Người dùng -->
                        <div class="card p-6">
                            <div class="text-2xl mb-5">♙</div>
                            <p class="text-sm text-slate-500">Người dùng</p>

                            <div class="flex justify-between items-center mt-2">
                                <b class="text-3xl">
                                    {{ number_format($totalUsers, 0, ',', '.') }}
                                </b>
                                <span class="text-xs text-slate-400">
                                    Tổng tài khoản
                                </span>
                            </div>
                        </div>

                        <!-- Tin đang bán -->
                        <div class="card p-6">
                            <div class="text-2xl mb-5">▤</div>
                            <p class="text-sm text-slate-500">Tin đang bán</p>

                            <div class="flex justify-between items-center mt-2">
                                <b class="text-3xl">
                                    {{ number_format($totalListings, 0, ',', '.') }}
                                </b>
                                <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-lg">
                                    Đang hiển thị
                                </span>
                            </div>
                        </div>

                        <!-- Chờ duyệt -->
                        <div class="card p-6">
                            <div class="text-2xl mb-5">◷</div>
                            <p class="text-sm text-slate-500">Chờ duyệt</p>

                            <div class="flex justify-between items-center mt-2">
                                <b class="text-3xl">
                                    {{ number_format($pendingListings, 0, ',', '.') }}
                                </b>
                                <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">
                                    Cần xử lý
                                </span>
                            </div>
                        </div>

                        <!-- Báo cáo -->
                        <div class="card p-6">
                            <div class="text-2xl mb-5">⚑</div>
                            <p class="text-sm text-slate-500">Báo cáo</p>

                            <div class="flex justify-between items-center mt-2">
                                <b class="text-3xl">
                                    {{ $totalReports === null ? '—' : number_format($totalReports) }}
                                </b>
                                <span class="text-xs text-slate-400">
                                    Chưa triển khai
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ -->
                    <div class="grid grid-cols-1 xl:grid-cols-5 gap-5 mb-5">

                        <!-- Tin đăng theo tháng -->
                        <div class="card p-6 xl:col-span-3">
                            <h2 class="font-bold text-lg">
                                Tin đăng theo tháng
                            </h2>
                            <p class="text-sm text-slate-400">
                                Số lượng tin đăng mới năm {{ $year }}
                            </p>
                            <div id="monthlyChart"></div>
                        </div>

                        <!-- Kiểm duyệt -->
                        <div class="card p-6 xl:col-span-2">
                            <h2 class="font-bold text-lg">
                                Mục tiêu kiểm duyệt
                            </h2>
                            <p class="text-sm text-slate-400">
                                Ước tính tỷ lệ xử lý tin trong tháng
                            </p>

                            <div id="goalChart"></div>

                            <div class="grid grid-cols-3 text-center border-t dark:border-slate-700 pt-4 text-sm">

                                <div>
                                    Chờ duyệt<br>
                                    <b>{{ number_format($pendingThisMonth) }}</b>
                                </div>

                                <div>
                                    Đã duyệt<br>
                                    <b>{{ number_format($approvedThisMonth) }}</b>
                                </div>

                                <div>
                                    Tỷ lệ xử lý<br>
                                    <b>{{ number_format($moderationRate, 2) }}%</b>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Hoạt động hệ thống -->
                    <div class="card p-6 mb-5">
                        <h2 class="font-bold text-lg">
                            Hoạt động hệ thống
                        </h2>
                        <p class="text-sm text-slate-400">
                            Xu hướng tin đăng và người dùng năm {{ $year }}
                        </p>
                        <div id="activityChart"></div>
                    </div>

                    <!-- Tin chờ duyệt gần đây -->
                    <div class="card p-6">
                        <h2 class="font-bold text-lg mb-4">
                            Tin chờ duyệt gần đây
                        </h2>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="text-slate-400 text-left border-b dark:border-slate-700">
                                    <tr>
                                        <th class="py-3">Sản phẩm</th>
                                        <th>Người bán</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>

                                <tbody id="recentTable">
                                    @forelse ($recentPending as $listing)
                                    <tr class="border-b dark:border-slate-700">

                                        <td class="py-3 font-medium">
                                            {{ $listing->title }}
                                        </td>

                                        <td>
                                            {{ $listing->user?->name ?? 'Không xác định' }}
                                        </td>

                                        <td>
                                            {{ $listing->price !== null
                                    ? number_format($listing->price, 0, ',', '.') . ' đ'
                                    : 'Thỏa thuận' }}
                                        </td>

                                        <td>
                                            <span class="text-xs text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">
                                                Chờ duyệt
                                            </span>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-slate-400">
                                            Không có tin đăng chờ duyệt.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>

                <section id="generic" class="page hidden">
                    <div class="card p-6">
                        <div class="flex flex-wrap gap-3 justify-between mb-5">
                            <div>
                                <h2 id="tableTitle" class="font-bold text-lg">Danh sách</h2>
                                <p class="text-sm text-slate-400">Bảng mẫu, chưa kết nối dữ liệu thật</p>
                            </div>
                            <div class="flex gap-2"><input id="filterTable"
                                    class="border dark:border-slate-600 dark:bg-slate-800 rounded-xl px-3 py-2 text-sm"
                                    placeholder="Tìm trong bảng..."><button id="addBtn"
                                    class="bg-indigo-600 text-white rounded-xl px-4 py-2 text-sm">+ Thêm mới</button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead id="genericHead" class="border-b dark:border-slate-700 text-slate-400"></thead>
                                <tbody id="genericBody"></tbody>
                            </table>
                        </div>
                        <p class="text-xs text-slate-400 mt-5">Các nút thao tác chỉ dùng để trình diễn giao diện, không
                            lưu thay đổi.</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <div id="toast"
        class="fixed bottom-5 right-5 z-50 bg-slate-900 text-white rounded-xl px-5 py-3 shadow-xl hidden text-sm"></div>
    <script>
    const titles = {
        dashboard: 'Tổng quan hệ thống',
        listings: 'Quản lý tin đăng',
        users: 'Quản lý người dùng',
        categories: 'Quản lý danh mục',
        reports: 'Báo cáo vi phạm',
        notifications: 'Thông báo',
        settings: 'Cài đặt hệ thống'
    };
    let current = 'dashboard';

    function toast(msg) {
        const el = document.getElementById('toast');
        el.textContent = msg;
        el.classList.remove('hidden');
        setTimeout(() => el.classList.add('hidden'), 2600)
    }

    function renderTable(filter = '') {
        const item = data[current];
        if (!item) return;
        document.getElementById('tableTitle').textContent = item.title;
        document.getElementById('genericHead').innerHTML = '<tr>' + item.head.map(x =>
            '<th class="py-3 pr-5 whitespace-nowrap">' + x + '</th>').join('') + '<th>Thao tác</th></tr>';
        document.getElementById('genericBody').innerHTML = item.rows.filter(r => r.join(' ').toLowerCase().includes(
                filter.toLowerCase())).map(r => '<tr class="border-b dark:border-slate-700">' + r.map(x =>
                    '<td class="py-4 pr-5 whitespace-nowrap">' + x + '</td>').join('') +
                '<td><button class="text-indigo-600 font-semibold demo-action">Xem</button></td></tr>').join('') ||
            '<tr><td class="py-5" colspan="8">Không có dữ liệu phù hợp</td></tr>';
        document.querySelectorAll('.demo-action').forEach(b => b.onclick = () => toast(
            'Đây là thao tác minh họa — chưa có backend.'))
    }

    function page(p) {
        current = p;
        document.getElementById('dashboard').classList.toggle('hidden', p !== 'dashboard');
        document.getElementById('generic').classList.toggle('hidden', p === 'dashboard');
        document.getElementById('pageTitle').textContent = titles[p];
        document.getElementById('breadcrumb').textContent = titles[p];
        document.querySelectorAll('.nav-item').forEach(el => el.classList.toggle('nav-active', el.dataset.page === p));
        if (p !== 'dashboard') {
            document.getElementById('filterTable').value = '';
            renderTable()
        }
        document.getElementById('sidebar').classList.add('-translate-x-full')
    }
    document.querySelectorAll('.nav-item').forEach(b => b.onclick = () => page(b.dataset.page));
    document.getElementById('menuBtn').onclick = () => document.getElementById('sidebar').classList.toggle(
        '-translate-x-full');
    document.getElementById('themeBtn').onclick = () => {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('cdc-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light')
    };
    if (localStorage.getItem('cdc-theme') === 'dark') document.documentElement.classList.add('dark');
    document.getElementById('filterTable').oninput = e => renderTable(e.target.value);
    document.getElementById('addBtn').onclick = () => toast('Chức năng thêm mới sẽ được kết nối Laravel sau.');
    document.getElementById('searchNav').oninput = e => {
        const s = e.target.value.toLowerCase();
        const found = Object.keys(titles).find(k => titles[k].toLowerCase().includes(s));
        if (s && found) page(found)
    };
    document.getElementById('recentTable').innerHTML = data.listings.rows.slice(0, 3).map(r =>
        '<tr class="border-b dark:border-slate-700"><td class="py-4">' + r[1] + '</td><td>' + r[2] + '</td><td>' +
        r[3] + '</td><td><span class="text-indigo-600">' + r[4] + '</span></td></tr>').join('');
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const months = [
            'T1', 'T2', 'T3', 'T4',
            'T5', 'T6', 'T7', 'T8',
            'T9', 'T10', 'T11', 'T12'
        ];

        const listings = @json($monthlyListings);
        const users = @json($monthlyUsers);
        const moderationRate = @json($moderationRate);

        // 1. Biểu đồ tin đăng theo tháng
        new ApexCharts(
            document.querySelector('#monthlyChart'), {
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Tin đăng mới',
                    data: listings
                }],
                xaxis: {
                    categories: months
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '42%'
                    }
                },
                colors: ['#6679FF'],
                dataLabels: {
                    enabled: false
                },
                yaxis: {
                    min: 0,
                    labels: {
                        formatter: value => Math.round(value)
                    }
                }
            }
        ).render();

        // 2. Biểu đồ kiểm duyệt
        new ApexCharts(
            document.querySelector('#goalChart'), {
                chart: {
                    type: 'radialBar',
                    height: 240
                },
                series: [moderationRate],
                colors: ['#6679FF'],
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        hollow: {
                            size: '65%'
                        },
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                offsetY: -5,
                                fontSize: '26px',
                                formatter: value =>
                                    Number(value).toFixed(2) + '%'
                            }
                        }
                    }
                },
                labels: ['Đã xử lý']
            }
        ).render();

        // 3. Biểu đồ hoạt động hệ thống
        new ApexCharts(
            document.querySelector('#activityChart'), {
                chart: {
                    type: 'area',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                        name: 'Tin đăng mới',
                        data: listings
                    },
                    {
                        name: 'Người dùng mới',
                        data: users
                    }
                ],
                xaxis: {
                    categories: months
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                colors: [
                    '#6679FF',
                    '#10B981'
                ],
                dataLabels: {
                    enabled: false
                }
            }
        ).render();

    });
    </script>
    +
</body>

</html>