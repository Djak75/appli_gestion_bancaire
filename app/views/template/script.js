// Ce script permet de cacher les alertes après 3 secondes
setTimeout(() => {
    let alert = document.querySelector(".alert");
    if (alert) {
        alert.style.display = "none";
    }
}, 3000);

// Mode sombre
