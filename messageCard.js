function displayMessageCard(msg, container){

    const card = document.createElement('div')
    card.classList.add('message')

    const p = document.createElement('p')
    p.innerHTML = msg

    card.appendChild(p)

    container.appendChild(card)

    alert("test")
}