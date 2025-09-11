document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("filter-toggle");
    const filterContent = document.getElementById("filter-content");
    const filterArrow = document.getElementById("filter-arrow");
    const startDate = document.getElementById("start_date");
    const endDate = document.getElementById("end_date");

    //  toggle
    if (filterArrow && filterContent) {
        filterArrow.addEventListener("click", function (e) {
            e.stopPropagation();
            const isHidden = filterContent.classList.toggle("hidden");
            filterArrow.classList.toggle("rotate-180", !isHidden);
            localStorage.setItem("filterVisible", !isHidden);
        });

        if (toggleButton) {
            toggleButton.addEventListener("click", function (e) {
                e.preventDefault();
            });
        }

        const filterVisible = localStorage.getItem("filterVisible");
        if (filterVisible === "true") {
            filterContent.classList.remove("hidden");
            filterArrow.classList.add("rotate-180");
        } else {
            filterContent.classList.add("hidden");
            filterArrow.classList.remove("rotate-180");
        }
    }

    // backdate and start_date
    if (startDate && endDate) {
        startDate.addEventListener("input", function () {
            if (startDate.value) {
                endDate.disabled = false;
            } else {
                endDate.disabled = true;
                endDate.value = "";
            }
        });

        startDate.addEventListener("change", () => {
            endDate.min = startDate.value;
            if (endDate.value && endDate.value < startDate.value) {
                endDate.value = "";
            }
        });

        if (startDate.value) {
            endDate.min = startDate.value;
            endDate.disabled = false;
        } else {
            endDate.disabled = true;
        }
    }
});
