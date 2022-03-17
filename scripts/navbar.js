const toggleButton = document.getElementsByClassName("navbar-toggle")[0];
const navbarLinks = document.getElementsByClassName("navbar-link");
const toggleIcon = toggleButton.childNodes[0];

function flipMenuIconWithCloseIcon() {
  if (toggleIcon.classList.contains("fa-bars")) {
    toggleIcon.classList.remove("fa-bars");
    toggleIcon.classList.add("fa-times");
  } else {
    toggleIcon.classList.remove("fa-times");
    toggleIcon.classList.add("fa-bars");
  }
}

toggleButton.addEventListener("click", () => {
  flipMenuIconWithCloseIcon();

  const navbarLinkArray = Array.from(navbarLinks);
  navbarLinkArray.forEach((link) => {
    link.classList.toggle("drawn-out");
  });
});
