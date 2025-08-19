document.addEventListener("DOMContentLoaded", function () {
    const revenueEl = document.querySelector("#AdminrevenueChart");
    const userGrowthEl = document.querySelector("#AdminuserGrowthChart");
    const revenueData = JSON.parse(revenueEl.dataset.revenue);
    const userGrowthData = JSON.parse(userGrowthEl.dataset.userGrowth);

    const revenueOptions = {
        series: [
            {
                name: "Revenue",
                data: revenueData.data,
            },
        ],
        chart: {
            type: "area",
            height: "100%",
            toolbar: {
                show: false,
                tools: {
                    download: true,
                },
            },
            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 800,
            },
            zoom: {
                enabled: false,
            },
        },
        colors: ["#4f6dab"],
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 90, 100],
            },
        },
        stroke: {
            curve: "smooth",
            width: 3,
        },
        dataLabels: {
            enabled: true,
        },
        xaxis: {
            categories: revenueData.labels,
            labels: {
                style: {
                    colors: "#6b7280",
                },
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: "#6b7280",
                },
                formatter: (value) => (value / 1_000_000).toFixed(1) + "M",
            },
        },
        grid: {
            borderColor: "#e5e7eb",
            strokeDashArray: 4,
            padding: {
                top: 20,
                right: 20,
                bottom: 0,
                left: 20,
            },
        },
        tooltip: {
            y: {
                formatter: (value) => "MMK " + value.toLocaleString(),
            },
        },
    };

    const userGrowthOptions = {
        series: [
            {
                name: "Users",
                data: userGrowthData.data,
            },
        ],
        chart: {
            type: "bar",
            height: "100%",
            toolbar: {
                show: true,
                tools: {
                    download: true,
                    reset: true,
                },
            },
        },
        colors: ["#4f6dab"],
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: "20%",
                endingShape: "rounded",
            },
        },
        dataLabels: {
            enabled: true,
        },
        xaxis: {
            categories: userGrowthData.labels,
            labels: {
                style: {
                    colors: "#6b7280",
                },
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: "#6b7280",
                },
            },
        },
        grid: {
            borderColor: "#e5e7eb",
            strokeDashArray: 4,
        },
        tooltip: {
            y: {
                formatter: (val) => val + " new users",
            },
        },
    };

    // Render charts
    const revenueChart = new ApexCharts(
        document.querySelector("#AdminrevenueChart"),
        revenueOptions
    );
    revenueChart.render();

    const userGrowthChart = new ApexCharts(
        document.querySelector("#AdminuserGrowthChart"),
        userGrowthOptions
    );
    userGrowthChart.render();



});
