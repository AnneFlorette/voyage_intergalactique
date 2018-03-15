function getMessageType(){
    MESSAGE_TYPE = []
    MESSAGE_TYPE["ERROR"] = 'error',
    MESSAGE_TYPE["WARNING"] = 'warning',
    MESSAGE_TYPE["INFO"] = 'info',
    MESSAGE_TYPE["SUCCESS"] = 'success'
    return MESSAGE_TYPE
}

function displayMessageCard(msg, img, type = "info", container){

    console.log(type)

    const card = document.createElement('div')
    card.classList.add('message', `message--${type}`)

    const imgCard = document.createElement('img')
    imgCard.classList.add('imgMessage')
    imgCard.src = img

    card.appendChild(imgCard)

    const p = document.createElement('p')
    p.innerHTML = msg

    card.appendChild(p)

    const i = document.createElement('i')
    i.classList.add('material-icons', 'message__dismiss')
    i.innerHTML = 'cancel'

    i.addEventListener('click', () => {
        card.remove()
    }, false)

    card.appendChild(i)

    container.appendChild(card)
}