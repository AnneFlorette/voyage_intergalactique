function testFunction(className) {
    switch (className){
        case 'Anne Flore':
        text = "Anne-Flore is the only one who's not human. She comes from Pluto and she decided to settle on Earth. Unfortunately she's been exposed and she had to face discrimination against plutorian because Humans were convinced that Pluto was not a real planet. She decided to prove they were wrong so she built with two friends this spatial agency to allow people to travel in Space and especially to Pluto."
            break
        case 'Cyrille':
            text = "Cyrille is one of the best developer in our galaxy. After studying in the famous School IMIE, he started to work as a freelance developer for famous organisations like the European Space Agency or the National Aeronautics and Space Administration. For five years now, he's part of this loving team."
            break
        case 'Hugo':
            text = "Hugo was a french comedian for seven years. He won a Molière for his performance in the famous Shakespeare's play, Halmet. This little genius was also earning his life as an anonymous developer fighting for Open Source. Far Away Company hired him five years ago thanks to his beliefs and impressive skills which seduce the talent manager."
            break
    }
    document.getElementById("teamMate").innerHTML = text // className pour afficher le nom du profil
}