(() => {
  const html = document.documentElement;
  const getTheme = () =>
    html.getAttribute("data-theme") === "dark" ? "dark" : "light";
  const setTheme = (t) => {
    html.setAttribute("data-theme", t);
    localStorage.setItem("theme", t);
  };
  const themeBtn = document.getElementById("themeToggle");
  const themeSplash = (x, y, toTheme, apply) => {
    const splash = document.createElement("div");
    splash.className = "theme-splash";
    splash.dataset.to = toTheme;
    splash.style.setProperty("--x", x + "px");
    splash.style.setProperty("--y", y + "px");
    document.body.appendChild(splash);
    splash.addEventListener(
      "animationend",
      () => {
        apply();
        splash.remove();
      },
      { once: true }
    );
  };
  if (themeBtn) {
    themeBtn.addEventListener("click", (ev) => {
      const next = getTheme() === "dark" ? "light" : "dark";
      const x = ev.clientX || innerWidth / 2;
      const y = ev.clientY || 72;
      const apply = () => setTheme(next);
      if (document.startViewTransition) {
        const vt = document.startViewTransition(apply);
        vt.ready.then(() => {
          const end = Math.hypot(
            Math.max(x, innerWidth - x),
            Math.max(y, innerHeight - y)
          );
          const from = `circle(0px at ${x}px ${y}px)`;
          const to = `circle(${end}px at ${x}px ${y}px)`;
          html.animate(
            { clipPath: [from, to] },
            {
              duration: 650,
              easing: "cubic-bezier(.2,.8,.2,1)",
              pseudoElement: "::view-transition-new(root)",
            }
          );
        });
      } else themeSplash(x, y, next, apply);
    });
  }
  const reveals = document.querySelectorAll(".reveal");
  if (reveals.length) {
    const io = new IntersectionObserver(
      (entries) =>
        entries.forEach(
          (e) =>
            e.isIntersecting &&
            (e.target.classList.add("on"), io.unobserve(e.target))
        ),
      { threshold: 0.2 }
    );
    reveals.forEach((el) => io.observe(el));
  }
  const skills = document.querySelectorAll(".skill");
  if (skills.length) {
    const run = (el) => {
      const val = Number(el.dataset.value || 0);
      const bar = el.querySelector(".skill-bar");
      if (!bar) return;
      bar.style.transition = "width 900ms cubic-bezier(.2,.8,.2,1)";
      bar.style.width = Math.max(0, Math.min(100, val)) + "%";
    };
    const io = new IntersectionObserver(
      (entries) =>
        entries.forEach(
          (e) => e.isIntersecting && (run(e.target), io.unobserve(e.target))
        ),
      { threshold: 0.35 }
    );
    skills.forEach((el) => io.observe(el));
  }
})();
