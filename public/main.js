// PC Toggle
const settingsBtn = document.getElementById('settingsBtn');
const settingsSection = document.getElementById('settingsSection');

// Mobile Menu Toggle
const mobileMenuToggle = document.getElementById("mobileMenuToggle");
const mobileMenu = document.getElementById("mobileMenu");





settingsBtn.addEventListener("click", function () {
    settingsSection.classList.remove("hidden");
  if (settingsSection.classList.contains("slided")) {
    settingsSection.classList.remove("slided");
  } else {
    settingsSection.classList.add("slided");
  }

});

mobileMenuToggle.addEventListener("click", function () {
  mobileMenu.classList.remove("hidden");
if (mobileMenu.classList.contains("slided")) {
  mobileMenu.classList.remove("slided");
} else {
  mobileMenu.classList.add("slided");
}

});






// settingsBtn.addEventListener('click', () => {
//     anime({
//         targets: '#settingsBtn',
//         scale: 1.2,
//         rotateZ: 100
//     }) 

//     // anime({
//     //     targets: settingsSection,
//     //     translateY: 500
//     // })
// })

