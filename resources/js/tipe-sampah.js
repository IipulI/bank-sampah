let modalId = null;
let overlay = document.querySelectorAll('.modal-overlay')
for(var i=0; i < overlay.length; i++){
    overlay[i].addEventListener('click', click)
}

function toggleModal (id) {
    const body = document.querySelector('body')
    const modal = document.getElementById(id)

    modalId = id

    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

document.onkeydown = function(evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
        isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal(modalId)
    }
};

function click(){
    overlay.addEventListener('click', toggleModal(modalId))
}
