<!doctype html>
<html lang="fr" data-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Libyangi est une application de gestion des événements et invitations : fête de mariage, fête d'anniversaire, reunion, baptêmes, soirées privées, et bien plus encore."> 
    <link rel="stylesheet" href="{{ asset('line-awesome-1.3.0/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/style-admin.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo libyangi mobile transp.png') }}" />
    <title>{{ config('app.name', 'Libyangi') }} - @yield('title')</title>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    @livewireStyles
  </head>

  <body>
    <div id="loader">
      <div class="loader-logo-img">
        <img src="{{ asset('images/logo libyangi mobile transp.png') }}" alt="logo" />
      </div>
    </div>

    <div x-data="toastSystem()" x-on:toast.window="add($event.detail)" class="toast-container" >
        <template x-for="(toast, index) in toasts" :key="index">
                <div class="app-toast" x-show="toast.show" x-transition :style="'border-left:5px solid ' + toast.color">
                    <span class="app-toast-icon" x-transition :style="'color: ' + toast.color" x-text="toast.icon"></span>
                    <span class="app-toast-message" x-text="toast.message"></span>
                </div>
        </template>
    </div>

    <!-- ================= HEADER ================= -->
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo libyangi mobile transp.png') }}" alt="logo" />
        </div>

        <div class="header-right">
            <!-- MODE -->
            <button class="btn-mode" onclick="toggleTheme()">
                <i id="theme-icon" class="la la-moon"></i>
            </button>

            <!-- NOTIFICATIONS -->
            <div class="icon-btn">
                <i class="la la-bell"></i>
                <span class="badge">3</span>
            </div>

            <!-- USER -->
            <div class="user" onclick="toggleDropdown()" title="{{ auth()->user()->name }}">
                <i class="la la-user-circle"></i>
                    {{ \Illuminate\Support\Str::limit(auth()->user()->name, 5, '...') }}

                <div class="dropdown" id="dropdown">
                    {{-- <a href="#" class="dropdown-a"><i class="la la-user"></i> Profil</a> --}}
                    <a href="{{ route('settings') }}" class="dropdown-a"><i class="la la-cog"></i> Paramètres</a>
                    <a href="#" class="dropdown-a">
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" 
                            class="icon-btns" 
                            title="Se déconnecter" 
                            style="border:none;background:transparent;margin:0;padding:0;cursor:pointer;">
                            <i class="la la-sign-out"></i> Déconnexion
                        </button>
                    </form>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= CONTENT ================= -->
    <div class="container">
        @yield('content')
    </div>

    <!-- ================= BOTTOM NAV ================= -->
    @include('partials.nav')

    @livewireScripts

    <script>
        function toastSystem() {
            return {
                toasts: [],

                add(data) {

                    const styles = {
                        success: { icon: '✔', color: 'var(--primary)' },
                        error:   { icon: '✖', color: 'var(--color-badge)' },
                        info:    { icon: 'ℹ', color: 'var(--secondary)' },
                        warning: { icon: '⚠', color: 'var(--accent)' },
                    };

                    let type = data.type ?? 'info';
                    let config = styles[type];

                    let toast = {
                        message: data.message ?? '',
                        icon: config.icon,
                        color: config.color,
                        show: true
                    };

                    this.toasts.push(toast);

                    setTimeout(() => {
                        toast.show = false;
                        setTimeout(() => {
                            this.toasts.shift();
                        }, 300);
                    }, data.duration ?? 3000);
                }
            }
        }
    </script>
    <script src="{{ asset('script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>

        const CHART_COLORS = [
            '#2563eb', '#10b981', '#f59e0b', '#ef4444',
            '#8b5cf6', '#14b8a6', '#f97316', '#22c55e',
            '#3b82f6', '#ec4899', '#eab308', '#6366f1'
        ];

        function chartComponent(initialData) {

            return {

                chart: null,
                data: initialData,

                init() {

                    this.renderChart();

                    window.addEventListener('updateChart', (event) => {
                        this.update(event.detail.chart);
                    });
                },

                renderChart() {

                    // Détruire ancien graphique
                    if (this.chart) {
                        this.chart.destroy();
                    }

                    this.chart = new ApexCharts(this.$el, {

                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },

                        series: this.data.series,

                        xaxis: {
                            categories: this.data.categories
                        },

                        plotOptions: {
                            bar: {
                                distributed: true,
                                borderRadius: 8,
                                columnWidth: '50%'
                            }
                        },

                        dataLabels: {
                            enabled: false
                        },

                        colors: CHART_COLORS
                    });

                    this.chart.render();
                },

                update(newData) {

                    this.data = newData;

                    if (!this.chart) {
                        this.renderChart();
                        return;
                    }

                    this.chart.updateOptions({
                        xaxis: {
                            categories: newData.categories
                        }
                    });

                    this.chart.updateSeries(newData.series);
                }
            }
        }

    </script>
  </body>
</html>
