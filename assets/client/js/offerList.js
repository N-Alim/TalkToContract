let categorie= document.querySelector('#selectCat').value;
let sous_cat= document.querySelector('#selectSousCat').value;
let ville= document.querySelector('#ville').value;
let department= document.querySelector('#department').value;
let hourMin= document.querySelector('#hourMin').value;
let hourMax= document.querySelector('#hourMax').value;
let jobName = document.querySelector("#jobName").value;
let expMin= document.querySelector("#expMin").value;
let expMax= document.querySelector("#expMax").value;
let pagination = 1;
let offerType= document.querySelector('select#selectOfferType').value;


const go = document.querySelector(".go");
go.addEventListener("click", getPagination);

const buttonPrev = document.querySelector("button.prev");
buttonPrev.addEventListener("click", () => 
{
    incrementPagination(-1)
});

const buttonNext = document.querySelector("button.next");
buttonNext.addEventListener("click", () => 
{
    incrementPagination(+1)
});

const buttonSubmit = document.querySelector(".submit")
buttonSubmit.addEventListener('click', getOffers); 

const axios = require('axios');
// const { pop } = require('core-js/core/array');

function getOffers(){

    categorie = document.querySelector('select#selectCat').value;
    sous_cat = document.querySelector('select#selectSousCat').value;
    ville = document.querySelector('#ville').value;
    department = document.querySelector('select#department').value;
    hourMin = document.querySelector('#hourMin').value;
    hourMax = document.querySelector('#hourMax').value;
    jobName = document.querySelector("#jobName").value;
    expMin = document.querySelector("#expMin").value;
    expMax = document.querySelector("#expMax").value;
    offerType= document.querySelector('select#selectOfferType').value;
    
    axios.get('http://localhost:4000/offer/get', {
    params: {
        job_name: jobName,
        week_hours_number_min: hourMin,
        week_hours_number_max: hourMax,
        town: ville,
        experience_min: expMin,
        experience_max: expMax,
        category_id: categorie,
        sub_category_id: sous_cat,
        offers_type_id: offerType,
        department_id: department,
        pagination: 1,
    }
})
    .then(function (response){
        const oldOffersList = document.querySelector('div.offers-cards')
        const offersList = document.createElement("div");
        offersList.className = "offers-cards";
        oldOffersList.replaceWith(offersList);

        for (let cnt = 0;  cnt < (response.data).length; ++ cnt)
        {
            offersList.appendChild(createOfferCard((response.data)[cnt]));
        }    
    })
    .catch(function (error){
        console.log(error);
    })

}

function getPagination(){

    pagination = document.querySelector('input.page-numbers.current').value;

    axios.get('http://localhost:4000/offer/get', {
    params: {
        job_name: jobName,
        week_hours_number_min: hourMin,
        week_hours_number_max: hourMax,
        town: ville,
        experience_min: expMin,
        experience_max: expMax,
        category_id: categorie,
        sub_category_id: sous_cat,
        offers_type_id: offerType,
        department_id: department,
        pagination: pagination,
    }
})
    .then(function (response){
        const oldOffersList = document.querySelector('div.offers-cards')
        const offersList = document.createElement("div");
        offerCard.className = "offers-cards";
        oldOffersList.replaceWith(offersList);

        for (let cnt = 0;  cnt < (response.data).length; ++ cnt)
        {
            offersList.appendChild(createOfferCard((response.data)[cnt]));
        }  
    })
    .catch(function (error){
        console.log(error);
    })

}

function incrementPagination(pagNumber){

    pagination += pagNumber;
    document.querySelector('input.page-numbers.current').innerText = pagination;

    axios.get('http://localhost:4000/offer/get', {
            params: {
                job_name: jobName,
                week_hours_number_min: hourMin,
                week_hours_number_max: hourMax,
                town: ville,
                experience_min: expMin,
                experience_max: expMax,
                category_id: categorie,
                sub_category_id: sous_cat,
                offers_type_id: offerType,
                department_id: department,
                pagination: pagination,
            }
})
    .then(function (response){
        const oldOffersList = document.querySelector('div.offers-cards')
        const offersList = document.createElement("div");
        offersList.className = "offers-cards";
        oldOffersList.replaceWith(offersList);

        for (let cnt = 0;  cnt < (response.data).length; ++ cnt)
        {
            offersList.appendChild(createOfferCard((response.data)[cnt]));
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

