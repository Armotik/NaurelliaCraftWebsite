console.log("Running JavaScript ...");

const options = {
  root: null,
  rootMargin: '0px',
  threshold: .2
}

const handleIntersect = function (entries, observer) {
  entries.forEach(entry => {
    if (entry.intersectionRatio > .2) {
      entry.target.classList.remove("invisible");
      observer.unobserve(entry.target);
    }
  });
}

let observer = new IntersectionObserver(handleIntersect, options);
document.querySelectorAll(".invisible").forEach(e => {
  observer.observe(e);
});
