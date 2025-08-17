document.addEventListener("DOMContentLoaded", function () {
        // Toggle filter visibility
    const toggleButton = document.getElementById("filter-toggle");
    const filterContent = document.getElementById("filter-content");
    const filterArrow = document.getElementById("filter-arrow");

    toggleButton.addEventListener("click", function () {
        const isHidden = filterContent.classList.toggle("hidden");
        filterArrow.classList.toggle("rotate-180", !isHidden);
        localStorage.setItem("filterVisible", !isHidden);
    });

    // Restore filter visibility from localStorage
    const filterVisible = localStorage.getItem("filterVisible");
    if (filterVisible === "false") {
        filterContent.classList.add("hidden");
        filterArrow.classList.remove("rotate-180");
    }
});
