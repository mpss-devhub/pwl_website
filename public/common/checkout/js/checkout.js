
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll(".tab-content").forEach((content) => {
        content.classList.add("hidden");
    });

    // Remove active style from all tabs
    document.querySelectorAll('[id$="-tab"]').forEach((tab) => {
        tab.classList.remove("text-blue-500", "border-blue-500", "active-tab");
        tab.classList.add("border-transparent");
    });

    // Show selected tab content
    document.getElementById(`${tabName}-content`).classList.remove("hidden");

    // Add active style to selected tab
    const activeTab = document.getElementById(`${tabName}-tab`);
    activeTab.classList.add("text-blue-500", "border-blue-500", "active-tab");
    activeTab.classList.remove("border-transparent");
}

