const btnBars = document.querySelectorAll(".btn");
const ShowEvents = document.querySelectorAll(".event-detail");

const menu  = document.querySelector('header .menu');
const navBar = document.querySelector('header nav');

menu.addEventListener('click', () => {
  navBar.classList.toggle('active');
});


btnBars.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        btnBars.forEach(btn => {
            btn.classList.remove('active');
        });
        btn.classList.add('active');

        ShowEvents.forEach(detail => {
            detail.classList.remove('active');
        });
        ShowEvents[index].classList.add('active');
    });
});


const btnBar = document.querySelectorAll(".btns");
const ShowEvent = document.querySelectorAll(".contenus");

btnBar.forEach((btns, index) => {
    btns.addEventListener('click', () => {
        btnBar.forEach(btns => {
            btns.classList.remove('active');
        });
        btns.classList.add('active');

        ShowEvent.forEach(detail => {
            detail.classList.remove('active');
        });
        ShowEvent[index].classList.add('active');
    });
});

const navLinks = document.querySelectorAll('nav a');
const sections = document.querySelectorAll('sections'); 


navLinks.forEach((btn,index)=>{
    btn.addEventListener('click', ()=>{
        navLinks.forEach(btn=>{
            btn.classList.remove('active'); 

        });
        btn.classList.add('active');
        sections.forEach(det =>{
            det.classList.remove('active');
        });
        sections[index].classList.add(active);

    });
});