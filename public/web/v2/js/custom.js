// Navbar color on scroll
const nav = document.querySelector(".navbar");
const setNav = () => {
    if (window.scrollY > 10) nav.classList.add("scrolled");
    else nav.classList.remove("scrolled");
};
setNav();
window.addEventListener("scroll", setNav);

function toArabicNumber(number) {
    const arabicDigits = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    return String(number)
        .split("")
        .map((d) => arabicDigits[d] || d)
        .join("");
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".ar-number").forEach((span) => {
        const number = span.textContent.trim();
        span.textContent = toArabicNumber(number);
    });
});
