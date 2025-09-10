const slides = document.querySelectorAll('.slide');
const nextBtn = document.querySelector('#next');
const prevBtn = document.querySelector('#prev');

slides.forEach(function(slide, index) {
  slide.style.left = `${index * 100}%`;
})

let counter = 0;

nextBtn.addEventListener('click', function() {
  counter++;
  carousel();
});

prevBtn.addEventListener('click', function() {
  counter--;
  carousel();
});

function carousel() {
  // working with the slides
  // if counter is at the end, go to the start
  if (counter === slides.length) {
    counter = 0;
  }
  // if counter is at the start, go to the end
  if (counter < 0) {
    counter = slides.length - 1;
  }

  slides.forEach(function(slide) {
    slide.style.transform = `translateX(-${counter * 100}%)`;
  });
}

// auto slide
setInterval(function() {
  counter++;
  carousel();
}, 5000);
