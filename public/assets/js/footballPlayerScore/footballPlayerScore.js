const filter = document.getElementById('filter');
const footballPlayer = document.getElementById('div-footballPlayer');
const footballTeam = document.getElementById('div-footballTeam');
const position = document.getElementById('div-position');

filter.addEventListener('change', (event) => {
    let filter_request = event.target.value;

    if(filter_request == '1'){
        footballPlayer.style.display = 'none';
        footballTeam.style.display = 'none';
        position.style.display = 'none';
    }else if(filter_request == '2'){
        footballPlayer.style.display = 'flex';
        footballTeam.style.display = 'none';
        position.style.display = 'none';
    }else if(filter_request == '3'){
        footballPlayer.style.display = 'none';
        footballTeam.style.display = 'flex';
        position.style.display = 'none';
    }else{
        footballPlayer.style.display = 'none';
        footballTeam.style.display = 'none';
        position.style.display = 'flex';
    }
});
