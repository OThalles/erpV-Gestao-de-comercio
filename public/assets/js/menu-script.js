function closeSearch(){
    document.querySelector('.menu-container').style.height = '5vh';
    document.removeEventListener('click', closeSearch)
}

document.querySelector('.menu-options ul li').addEventListener('click', function(){
    document.querySelector('.menu-container').style.height = '35vh';
    document.querySelector('.menu-options').style.width = '100vw';

    setTimeout(()=>{
        document.addEventListener('click', closeSearch);
    },400)
})

document.querySelector('.submenu')
