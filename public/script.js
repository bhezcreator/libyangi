window.addEventListener("load", function () {
  setTimeout(() => {
    document.getElementById("loader").style.opacity = "0";
    document.getElementById("loader").style.transition = "0.5s";

    setTimeout(() => {
      document.getElementById("loader").style.display = "none";
      document.getElementById("content").style.display = "block";
    }, 500);
  }, 2000); // durée du loader (2 secondes)
});

function toggleDropdown() {
  const d = document.getElementById("dropdown");
  d.style.display = d.style.display === "block" ? "none" : "block";
}

function setActive(el) {
  document.querySelectorAll(".nav-item").forEach((item) => {
    item.classList.remove("active");
  });

  el.classList.add("active");
}

document.addEventListener("click", function (e) {
  if (!e.target.closest(".user")) {
    document.getElementById("dropdown").style.display = "none";
  }
});

// Gestion de mode de thème
function toggleTheme() {
  const html = document.documentElement;
  const icon = document.getElementById("theme-icon");

  const newTheme = html.dataset.theme === "dark" ? "light" : "dark";
  html.dataset.theme = newTheme;

  localStorage.setItem("theme", newTheme);

  updateIcon(newTheme);
}

// Met à jour l’icône
function updateIcon(theme) {
  const icon = document.getElementById("theme-icon");

  if (theme === "dark") {
    icon.className = "la la-sun"; // ☀️
  } else {
    icon.className = "la la-moon"; // 🌙
  }
}

// Initialisation
document.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme");

  let theme = "light";

  if (savedTheme) {
    theme = savedTheme;
  } else {
    const prefersDark = window.matchMedia(
      "(prefers-color-scheme: dark)",
    ).matches;
    theme = prefersDark ? "dark" : "light";
  }

  document.documentElement.dataset.theme = theme;
  updateIcon(theme);
});
