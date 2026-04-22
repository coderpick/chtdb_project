(function () {
  const sidebar = document.getElementById("adminSidebar");
  const toggle = document.getElementById("sidebarToggle");
  const overlay = document.getElementById("sidebarOverlay");
  const isMobile = () => window.innerWidth < 768;
  const STORAGE_KEY = "chtdb_sidebar_collapsed";

  // Auto-close on mobile load or restore saved state on desktop
  if (isMobile() || localStorage.getItem(STORAGE_KEY) === "1") {
    sidebar.classList.add("collapsed");
  }

  toggle.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");

    if (isMobile()) {
      overlay.classList.toggle(
        "visible",
        !sidebar.classList.contains("collapsed"),
      );
    } else {
      // Persist desktop state
      localStorage.setItem(
        STORAGE_KEY,
        sidebar.classList.contains("collapsed") ? "1" : "0",
      );
    }
  });

  // Close on overlay click (mobile)
  overlay.addEventListener("click", function () {
    sidebar.classList.add("collapsed");
    overlay.classList.remove("visible");
  });

  // On resize – handle mobile/desktop transitions
  window.addEventListener("resize", function () {
    if (isMobile()) {
      sidebar.classList.add("collapsed");
      overlay.classList.remove("visible");
    } else {
      overlay.classList.remove("visible");
      // Restore desktop state from storage
      if (localStorage.getItem(STORAGE_KEY) === "1") {
        sidebar.classList.add("collapsed");
      } else {
        sidebar.classList.remove("collapsed");
      }
    }
  });
})();
