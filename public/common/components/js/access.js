document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".module-toggle").forEach((toggle) => {
        toggle.addEventListener("change", function () {
            const moduleContainer = this.closest(".module-container");
            const hiddenCheckbox =
                moduleContainer.querySelector(".module-checkbox");
            const actionCheckboxes =
                moduleContainer.querySelectorAll(".action-checkbox");

            hiddenCheckbox.checked = this.checked;
            actionCheckboxes.forEach((cb) => (cb.checked = this.checked));
        });
    });

    document.querySelectorAll(".action-checkbox").forEach((action) => {
        action.addEventListener("change", function () {
            const moduleContainer = this.closest(".module-container");
            const moduleToggle =
                moduleContainer.querySelector(".module-toggle");
            const hiddenCheckbox =
                moduleContainer.querySelector(".module-checkbox");
            const anyChecked = [
                ...moduleContainer.querySelectorAll(".action-checkbox"),
            ].some((cb) => cb.checked);

            moduleToggle.checked = anyChecked;
            hiddenCheckbox.checked = anyChecked;
        });
    });
});
