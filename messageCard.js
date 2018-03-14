function displayMessageCard(msg){

    const card = document.createElement('div')
    card.classList.add('message')

    const p = document.createElement('p')
    p.innerHTML = msg

    card.appendChild(p)

    document.getElementById("messageContainer").appendChild(card)
}