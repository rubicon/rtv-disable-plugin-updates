document.addEventListener("DOMContentLoaded", function () {
  // Toggle All On button
  document.getElementById("toggle-all-on").addEventListener("click", function () {
    document.querySelectorAll('.plugin-row input[type="checkbox"]').forEach(function (checkbox) {
      checkbox.checked = true;
    });
  });

  // Toggle All Off button
  document.getElementById("toggle-all-off").addEventListener("click", function () {
    document.querySelectorAll('.plugin-row input[type="checkbox"]').forEach(function (checkbox) {
      checkbox.checked = false;
    });
  });

  // Reset to Defaults button with confirmation prompt
  document.getElementById("reset-to-defaults").addEventListener("click", function () {
    if (confirm("Are you sure you want to reset to defaults?")) {
      document.querySelectorAll('.plugin-row input[type="checkbox"]').forEach(function (checkbox) {
        checkbox.checked = false;
      });
    }
  });

  // Filter buttons functionality
  document.querySelectorAll(".filters button").forEach(function (button) {
    button.addEventListener("click", function () {
      var filter = this.getAttribute("data-filter");
      document.querySelectorAll(".plugin-row").forEach(function (row) {
        if (filter === "all") {
          row.style.display = "";
        } else if (filter === "ignored") {
          row.style.display = row.classList.contains("ignored") ? "" : "none";
        } else if (filter === "not-ignored") {
          row.style.display = row.classList.contains("not-ignored") ? "" : "none";
        }
      });
    });
  });

  // Toggle All checkbox (if used) functionality
  document.getElementById("toggle-all").addEventListener("change", function () {
    var state = this.checked;
    document.querySelectorAll('.plugin-row input[type="checkbox"]').forEach(function (checkbox) {
      checkbox.checked = state;
    });
  });
});
