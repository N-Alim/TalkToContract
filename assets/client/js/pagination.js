let pagination = document.querySelector('input.page-numbers');
let buttonGo = document.querySelector('.go');
let buttonSubmit = document.querySelector('button.submit');
// let createCard ="";
let pagePrev = document.querySelector(".prev");
let pageNext = document.querySelector(".next");
let offersCards = document.querySelector("offers-cards");
let jobName = document.querySelector(".jobName");

let resultat; 

$('#nbrPagination').pagination ({
    dataSource: []
})