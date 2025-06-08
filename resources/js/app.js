import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// Remove any duplicate imports
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Wait for DOM and ensure proper initialization
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded - initializing charts');

    // Verify chart containers exist
    const revenueEl = document.getElementById('revenueChart');
    const transactionEl = document.getElementById('transactionTypesChart');

    if (!revenueEl && !transactionEl) {
        console.warn('Chart containers not found');
        return;
    }

    // Dynamic import with error handling
    import('apexcharts').then((module) => {
        const ApexCharts = module.default;
        console.log('ApexCharts loaded successfully', ApexCharts);

        // Initialize Revenue Chart
        if (revenueEl) {
            try {
                new ApexCharts(revenueEl, {
                    series: [{
                        name: 'Revenue',
                        data: [3000, 4200, 5100, 6200, 7100, 8100, 9100, 10300, 11100, 12300, 13100, 14300]
                    }],
                    chart: {
                        type: 'area',
                        height: '100%',
                        animations: { enabled: false }, // Disable for debugging
                        toolbar: { show: false }
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    }
                }).render();
                console.log('Revenue chart rendered');
            } catch (e) {
                console.error('Revenue chart error:', e);
            }
        }

        // Initialize Transaction Types Chart
        if (transactionEl) {
            try {
                new ApexCharts(transactionEl, {
                    series: [44, 55, 13, 43, 22],
                    chart: {
                        type: 'donut',
                        height: '100%'
                    },
                    labels: ['Credit Card', 'Bank Transfer', 'PayWith Link', 'Mobile Money', 'Other'],
                    responsive: [{
                        breakpoint: 480,
                        options: { chart: { width: 200 } }
                    }]
                }).render();
                console.log('Transaction chart rendered');
            } catch (e) {
                console.error('Transaction chart error:', e);
            }
        }
    }).catch(err => {
        console.error('Failed to load ApexCharts:', err);
    });
});
