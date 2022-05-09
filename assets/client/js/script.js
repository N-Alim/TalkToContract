


console.log('coucou');

const axios = require('axios');
// const { pop } = require('core-js/core/array');

function getOffers(){
    axios.get('http://localhost:4000/offer/get', {
    params: {
        job_name: document.querySelector('input#jobName').value,
        week_hours_number_min: document.querySelector('input#hour-range-left').value,
        week_hours_number_max: document.querySelector('input#hour-range-right').value,
        town: document.querySelector('input#ville').value,
        experience_min: document.querySelector('input#experience-range-left').value,
        experience_max: document.querySelector('input#experience-range-right').value,
        category_id: document.querySelector('select#selectCat').value,
        sub_category_id:document.querySelector('select#selectSousCat').value,
        offers_type_id: document.querySelector('select#selectOfferType').value,
        department_id: document.querySelector('select#selectDepartment').value,
        pagination: document.querySelector('input#nbrPagination').value
    }
})
    .then(function (response){
        console.log(response.data);
    })
    .catch(function (error){
        console.log(error);
    })

}

// document.querySelector('div.test').addEventListener('click',  getOffers)
// document.querySelector('div.test').addEventListener('click',  getOffers)

// POP UP

function popupFunction() {
    var popup = document.getElementById("myPopUp");
    popup.classList.toggle("show");
}
// document.querySelector('div.popup').addEventListener('click', popupFunction);