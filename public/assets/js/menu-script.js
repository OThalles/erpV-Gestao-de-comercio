function closeSearch(){
    document.querySelector('.menu-container').style.height = '5vh';
    document.removeEventListener('click', closeSearch)
}

let show_menu_mobile = false;

document.querySelector('.menu-options ul li').addEventListener('click', function(){
    let menucontainer = document.querySelector('.menu-container')
    if(show_menu_mobile==false) {
        menucontainer.style.height = '100vh';
        show_menu_mobile = true
    } else {
        menucontainer.style.height = '5vh';
        show_menu_mobile = false;
    }

})




let show_submenus = false;

document.querySelector('.stock-control').addEventListener('click', function(){
    let submenu_addproduct = document.querySelector('.addproduct')
    let submenu_addstock = document.querySelector('.addstock')
    if(show_submenus==false) {
        submenu_addproduct.classList.remove('hidden')
        submenu_addstock.classList.remove('hidden')
        show_submenus = true
    } else {
        submenu_addproduct.classList.toggle('hidden')
        submenu_addstock.classList.toggle('hidden')
        show_submenus = false
    }
})
