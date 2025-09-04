document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("filter-toggle");
    const filterContent = document.getElementById("filter-content");
    const filterArrow = document.getElementById("filter-arrow");

    filterArrow.addEventListener("click", function (e) {
        e.stopPropagation();
        const isHidden = filterContent.classList.toggle("hidden");
        filterArrow.classList.toggle("rotate-180", !isHidden);
        localStorage.setItem("filterVisible", !isHidden);
    });

    toggleButton.addEventListener("click", function (e) {
        e.preventDefault();
    });

    const filterVisible = localStorage.getItem("filterVisible");
    if (filterVisible === "true") {
        filterContent.classList.remove("hidden");
        filterArrow.classList.add("rotate-180");
    } else {
        filterContent.classList.add("hidden");
        filterArrow.classList.remove("rotate-180");
    }
});
