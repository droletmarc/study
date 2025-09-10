// select modal-btn,modal-overlay,close-btn
// listen for click events on modal-btn and close-btn
// when user clicks modal-btn add .open-modal to modal-overlay
// when user clicks close-btn remove .open-modal from modal-overlay
modalItem = document.querySelector(".modal-btn")
overlayItem = document.querySelector(".modal-overlay")
closeItem = document.querySelector(".close-btn")

modalItem.addEventListener("click", function () {
  overlayItem.classList.add("open-modal")
})

closeItem.addEventListener("click", function () {
  overlayItem.classList.remove("open-modal")
})
