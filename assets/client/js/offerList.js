let categorie= document.querySelector('#selectCat');
let sous_cat= document.querySelector('#selectSousCat');
let ville= document.querySelector('#ville');
let department= document.querySelector('#department');
let hourMin= document.querySelector('#hourMin');
let hourMax= document.querySelector('#hourMax');
let jobName = document.querySelector("#jobName");
let expMin= document.querySelector("#expMin");
let expMax= document.querySelector("#expMax");
let pagination = 1;
let offerType= document.querySelector('select#selectOfferType');


const go = document.querySelector(".go");
go.addEventListener("click", getPagination);

const buttonPrev = document.querySelector(".prev");
buttonPrev.addEventListener("click", () => 
{
    incrementPagination(-1)
});

const buttonNext = document.querySelector(".next");
buttonPrev.addEventListener("click", () => 
{
    incrementPagination(+1)
});

const buttonSubmit = document.querySelector(".submit")
buttonSubmit.addEventListener('click', getOffers); 

const axios = require('axios');
// const { pop } = require('core-js/core/array');

function getOffers(){

    categorie = document.querySelector('#selectCat');
    sous_cat = document.querySelector('#selectSousCat');
    ville = document.querySelector('#ville');
    department = document.querySelector('#department');
    hourMin = document.querySelector('#hourMin');
    hourMax = document.querySelector('#hourMax');
    jobName = document.querySelector("#jobName");
    expMin = document.querySelector("#expMin");
    expMax = document.querySelector("#expMax");
    offerType= document.querySelector('select#selectOfferType');
    
    axios.get('http://localhost:4000/offer/get', {
    params: {
        job_name: jobName,
        week_hours_number_min: hourMin,
        week_hours_number_max: hourMax,
        town: ville,
        experience_min: expMin,
        experience_max: expMax,
        category_id: selectCat,
        sub_category_id: selectSousCat,
        offers_type_id: selectOfferType,
        department_id: department,
        pagination: 1,
    }
})
    .then(function (response){
        const oldOffersList = document.querySelector('div.offers-cards')
        const offersList = document.createElement("div");
        offerCard.className = "offers-cards";
        oldOffersList.replaceWith(offersList);

        for (const offer in response.data)
        {
            offersList.appendChild(createOfferCard(offer));
        }    
    })
    .catch(function (error){
        console.log(error);
    })

}

function getPagination(){

    pagination = document.querySelector('.pagination');

    axios.get('http://localhost:4000/offer/get', {
    params: {
        job_name: jobName,
        week_hours_number_min: hourMin,
        week_hours_number_max: hourMax,
        town: ville,
        experience_min: expMin,
        experience_max: expMax,
        category_id: selectCat,
        sub_category_id: selectSousCat,
        offers_type_id: selectOfferType,
        department_id: department,
        pagination: pagination,
    }
})
    .then(function (response){
        const oldOffersList = document.querySelector('div.offers-cards')
        const offersList = document.createElement("div");
        offerCard.className = "offers-cards";
        oldOffersList.replaceWith(offersList);

        for (const offer in response.data)
        {
            offersList.appendChild(createOfferCard(offer));
        }  
    })
    .catch(function (error){
        console.log(error);
    })

}

function incrementPagination(pagNumber){

    pagination += pagNumber;

    axios.get('http://localhost:4000/offer/get', {
    params: {
        job_name: jobName,
        week_hours_number_min: hourMin,
        week_hours_number_max: hourMax,
        town: ville,
        experience_min: expMin,
        experience_max: expMax,
        category_id: selectCat,
        sub_category_id: selectSousCat,
        offers_type_id: selectOfferType,
        department_id: department,
        pagination: pagination,
    }
})
    .then(function (response){
        const oldOffersList = document.querySelector('div.offers-cards')
        const offersList = document.createElement("div");
        offerCard.className = "offers-cards";
        oldOffersList.replaceWith(offersList);

        for (const offer in response.data)
        {
            offersList.appendChild(createOfferCard(offer));
        }  
    })
    .catch(function (error){
        console.log(error);
    })

}

function createOfferCard(offerData)
{   
    const offerLink = document.createElement("a");
    offerLink.href = "http://localhost:4000/offer/" + toString(offerData.id);
    offerLink.innerText = offerData.job_name;

    const jobName = document.createElement("h2");
    jobName.appendChild(offerLink);

    const cat = document.createElement("div");
    cat.innerText = offerData.category;

    const subCat = document.createElement("div");
    subCat.innerText = offerData.sub_category;

    const department = document.createElement("div");
    department.innerText = offerData.department;

    const hours = document.createElement("div");
    hours.innerText = offerData.week_hours_number;

    const exp = document.createElement("div");
    exp.innerText = offerData.experience;

    const offerCard = document.createElement("div");
    offerCard.className = "offer-card";
    offerCard.appendChild(jobName);
    offerCard.appendChild(cat);
    offerCard.appendChild(subCat);
    offerCard.appendChild(department);
    offerCard.appendChild(hours);
    offerCard.appendChild(exp);

    return offerCard;
}

