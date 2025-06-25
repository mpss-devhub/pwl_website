@extends('Admin.layouts.dashboard')
@section('admin_content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="p-4 sm:ml-64 bg-gray-50">
        <div class="p-4 rounded-lg mt-14">
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard Overview</h1>
                <div class="flex space-x-3">
                    <button
                        class="px-4 py-2 bg-white border border-gray-200 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Export Report
                    </button>
                    <button class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700">
                        Generate Report
                    </button>
                </div>
            </div>

            <!-- Stats Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-2xl font-semibold text-gray-800">2,456</p>
                            <!--<p class="text-xs text-green-500 mt-1">+ 5.2% from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Merchants -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Merchants</p>
                            <p class="text-2xl font-semibold text-gray-800">184</p>
                           <!-- <p class="text-xs text-green-500 mt-1">+ 3.1% from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Transaction Amount</p>
                            <div class="flex ">
                                <p class="text-2xl font-semibold text-gray-800"> 5561289456 </p><small
                                    class="text-muted text-gray-500 mt-2 mx-1">MMK</small>
                            </div>
                            <!--<p class="text-xs text-red-500 mt-1">- 1.4% from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Transaction</p>
                            <p class="text-2xl font-semibold text-gray-800">23</p>
                            <!--<p class="text-xs text-red-500 mt-1">- 2 from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-yellow-50 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Revenue Analytics</h3>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-xs bg-blue-50 text-blue-600 rounded-md">Year</button>
                            <button
                                class="px-3 py-1 text-xs bg-white border border-gray-200 text-gray-600 rounded-md">Month</button>
                            <button
                                class="px-3 py-1 text-xs bg-white border border-gray-200 text-gray-600 rounded-md">Week</button>
                        </div>
                    </div>
                    <div class="h-80">
                        <!-- Chart container - Replace with your actual chart implementation -->
                        <div class="flex items-center justify-center h-full bg-gray-50 rounded-md">
                           <div id="revenueChart" class="w-full" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <!-- User Growth Chart -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">User Growth</h3>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-xs bg-blue-50 text-blue-600 rounded-md">Year</button>
                            <button
                                class="px-3 py-1 text-xs bg-white border border-gray-200 text-gray-600 rounded-md">Month</button>
                            <button
                                class="px-3 py-1 text-xs bg-white border border-gray-200 text-gray-600 rounded-md">Week</button>
                        </div>
                    </div>
                    <div class="h-80">
                        <!-- Chart container - Replace with your actual chart implementation -->
                        <div class="flex items-center justify-center h-full bg-gray-50 rounded-md">
                            <div id="userGrowthChart" class="w-full" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--lastmothly transactuin-->
            <div class="bg-white rounded-lg shadow mb-6">

                <button id="filter-toggle" class="w-full flex justify-between items-center p-6 focus:outline-none">
                    <h2 class="text-lg font-semibold text-gray-800"> Last Month Transaction</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="filter-content" id="filter-content">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 justify-around">
                        <!-- Total Users -->
                        <div class="bg-white p-5 rounded-lg shadow border border-gray-100 ">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                                    <p class="text-2xl font-semibold text-gray-800">2,456</p>
                                    <p class="text-xs text-green-500 mt-1">+ 5.2% from yesterday</p>
                                </div>
                                <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Active Merchants -->
                        <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Active Merchants</p>
                                    <p class="text-2xl font-semibold text-gray-800">184</p>
                                    <p class="text-xs text-green-500 mt-1">+ 3.1% from yesterday</p>
                                </div>
                                <div class="p-3 rounded-full bg-green-50 text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Revenue -->
                        <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Transaction Amount</p>
                                    <div class="flex ">
                                        <p class="text-2xl font-semibold text-gray-800"> 5561289456 </p><small
                                            class="text-muted text-gray-500 mt-2 mx-1">MMK</small>
                                    </div>
                                    <p class="text-xs text-red-500 mt-1">- 1.4% from yesterday</p>
                                </div>
                                <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Approvals -->
                        <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Transaction</p>
                                    <p class="text-2xl font-semibold text-gray-800">23</p>
                                    <p class="text-xs text-red-500 mt-1">- 2 from yesterday</p>
                                </div>
                                <div class="p-3 rounded-full bg-yellow-50 text-yellow-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleButton = document.getElementById('filter-toggle');
                    const filterContent = document.getElementById('filter-content');
                    const filterArrow = document.getElementById('filter-arrow');

                    // Toggle visibility of filter content
                    toggleButton.addEventListener('click', function() {
                        const isHidden = filterContent.classList.toggle('hidden');
                        filterArrow.classList.toggle('rotate-180', !isHidden);

                        // Store state in localStorage
                        localStorage.setItem('filterVisible', !isHidden);
                    });

                    // Check localStorage for saved state
                    const filterVisible = localStorage.getItem('filterVisible');
                    if (filterVisible === 'false') {
                        filterContent.classList.add('hidden');
                        filterArrow.classList.remove('rotate-180');
                    }
                });
            </script>

            <!-- Bottom Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100 lg:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="p-2 bg-blue-50 rounded-full text-blue-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">New merchant registration</p>
                                <p class="text-xs text-gray-500">"Best Electronics" registered as a new merchant</p>
                                <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="p-2 bg-green-50 rounded-full text-green-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Payment processed</p>
                                <p class="text-xs text-gray-500">$1,245.00 payment from Merchant ID #4567</p>
                                <p class="text-xs text-gray-400 mt-1">15 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="p-2 bg-purple-50 rounded-full text-purple-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Profile updated</p>
                                <p class="text-xs text-gray-500">Admin "John Doe" updated their profile information</p>
                                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 bg-red-50 rounded-full text-red-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Failed login attempt</p>
                                <p class="text-xs text-gray-500">5 failed login attempts from IP 192.168.1.45</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Stats</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm font-medium text-blue-800">New User Registion</p>
                            <p class="text-2xl font-semibold text-blue-600">42</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-sm font-medium text-green-800">Today's Transaction Amount </p>
                            <p class="text-2xl font-semibold text-green-600">3,00000 MMK</p>
                        </div>
                        <div class="p-4 bg-purple-50 rounded-lg">
                            <p class="text-sm font-medium text-purple-800">Today SMS </p>
                            <p class="text-2xl font-semibold text-purple-600">28</p>
                        </div>
                        <div class="p-4 bg-yellow-50 rounded-lg">
                            <p class="text-sm font-medium text-yellow-800">Pending Payment</p>
                            <p class="text-2xl font-semibold text-yellow-600">14</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  // Theme colors from your dashboard
  const colors = {
    primary: '#3b82f6',    // Tailwind blue-500
    success: '#10b981',    // Tailwind emerald-500
    danger: '#ef4444',     // Tailwind red-500
    warning: '#f59e0b',    // Tailwind amber-500
    info: '#06b6d4',       // Tailwind cyan-500
    dark: '#1f2937',       // Tailwind gray-800
    light: '#f3f4f6'       // Tailwind gray-100
  };

  // Revenue Chart (Line Chart)
  const revenueOptions = {
    series: [{
      name: 'Revenue',
      data: [4000000, 4300000, 4500000, 5200000, 5400000, 6000000, 5800000, 6100000, 7000000, 7500000, 8000000, 8500000]
    }],
    chart: {
      height: '100%',
      type: 'area',
      toolbar: {
        show: true,
        tools: {
          download: true,
          selection: false,
          zoom: false,
          zoomin: false,
          zoomout: false,
          pan: false,
          reset: true
        }
      },
      animations: {
        enabled: true,
        easing: 'easeinout',
        speed: 800
      }
    },
    colors: [colors.primary],
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.2,
        stops: [0, 90, 100]
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      labels: {
        style: {
          colors: '#6b7280' // Tailwind gray-500
        }
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: '#6b7280' // Tailwind gray-500
        },
        formatter: function(value) {
          return (value / 1000000) + 'M'; // Convert to millions
        }
      }
    },
    grid: {
      borderColor: '#e5e7eb', // Tailwind gray-200
      strokeDashArray: 4,
      padding: {
        top: 20,
        right: 20,
        bottom: 0,
        left: 20
      }
    },
    tooltip: {
      y: {
        formatter: function(value) {
          return 'MMK ' + value.toLocaleString(); // Format as currency
        }
      }
    }
  };

  // User Growth Chart (Bar Chart)
  const userGrowthOptions = {
    series: [{
      name: 'Users',
      data: [400, 430, 450, 520, 540, 600, 580, 610, 700, 750, 800, 850]
    }],
    chart: {
      height: '100%',
      type: 'bar',
      toolbar: {
        show: true,
        tools: {
          download: true,
          selection: false,
          zoom: false,
          zoomin: false,
          zoomout: false,
          pan: false,
          reset: true
        }
      }
    },
    colors: [colors.primary],
    plotOptions: {
      bar: {
        borderRadius: 6,
        columnWidth: '70%',
        endingShape: 'rounded'
      }
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      labels: {
        style: {
          colors: '#6b7280' // Tailwind gray-500
        }
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: '#6b7280' // Tailwind gray-500
        }
      }
    },
    grid: {
      borderColor: '#e5e7eb', // Tailwind gray-200
      strokeDashArray: 4
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + " new users";
        }
      }
    }
  };

  // Render charts
  const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
  revenueChart.render();

  const userGrowthChart = new ApexCharts(document.querySelector("#userGrowthChart"), userGrowthOptions);
  userGrowthChart.render();
</script>
@endsection
