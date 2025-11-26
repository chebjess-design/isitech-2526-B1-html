// Sélection du bouton
const toggleBtn = document.getElementById("toggle-theme");

// Vérifie si un thème est déjà sauvegardé
if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark");
  toggleBtn.textContent = "☀️ Mode clair";
}

// Événement au clic
toggleBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark");

  if (document.body.classList.contains("dark")) {
    toggleBtn.textContent = "☀️ Mode clair";
    localStorage.setItem("theme", "dark");
  } else {
    toggleBtn.textContent = "🌙 Mode sombre";
    localStorage.setItem("theme", "light");
  }
});