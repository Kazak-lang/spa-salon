const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click', function(){
    const userBox = document.querySelector('.profile');
    userBox.classList.toggle('active');
})

const searchForm = document.querySelector('.header .flex .search-form');
const profile = document.querySelector('.header .flex .profile');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    profile.classList.remove('active');

    console.log(searchForm);
}

const toggle = document.querySelector('#menu-btn');
toggle.addEventListener('click', function(){
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
})

var slider = document.getElementById('slider');
var line1 = document.getElementById('line1_id');
var line2 = document.getElementById('line2_id');
var line3 = document.getElementById('line3_id');
var line4 = document.getElementById('line4_id');
var active = document.getElementById('active_id');

line1.onclick = function(){
    slider.style.transform = 'translateX(0)';
    active.style.top = '0px';
}
line2.onclick = function(){
    slider.style.transform = 'translateX(-25%)';
    active.style.top = '80px';
}
line3.onclick = function(){
    slider.style.transform = 'translateX(-50%)';
    active.style.top = '160px';
}
line4.onclick = function(){
    slider.style.transform = 'translateX(-75%)';
    active.style.top = '240px';
}

//accordian 

const accordian = document.querySelectorAll('.contentBox');

for(let i = 0; i < accordian.length; i++){
    accordian[i].addEventListener('click', function(){
        this.classList.toggle('active');
    })
}

document.addEventListener('DOMContentLoaded', function() {
    IMask(
        document.getElementById('phone'),
        {
            mask: '+{375}(00)000-00-00'
        }
    );
});



    
    
