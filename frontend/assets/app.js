const app = document.getElementById('root');

const container = document.createElement('div');
container.setAttribute('class', 'container');
app.appendChild(container);

const slider = document.createElement('div');
slider.setAttribute('id', 'slider');
container.appendChild(slider);

const showrooms = document.createElement('div');
showrooms.setAttribute('id', 'showrooms');
container.appendChild(showrooms);

const content = document.createElement('div');
content.setAttribute('id', 'content');
container.appendChild(content);

const hotCars = document.createElement('div');
hotCars.setAttribute('id', 'hot-cars');
container.appendChild(hotCars);

const partners = document.createElement('div');
partners.setAttribute('id', 'partners');
partners.setAttribute('class', 'section');
container.appendChild(partners);

 //generate home template section
 makeRequest('http://localhost/task/wp-json/starter/v1/home', genHome);

//showrooms
makeRequest('http://localhost/task/wp-json/starter/v1/showrooms', genShowrooms);

//showrooms
makeRequest('http://localhost/task/wp-json/starter/v1/cars-hot', genCarsHot);




function makeRequest(url, func){
    var request = new XMLHttpRequest();
    request.open('GET', url, true);
    request.onload = function() {
        // Begin accessing JSON data here
        var data = JSON.parse(this.response);
        console.log(data);     
        func(data);         
    }
    request.send();
}

//home
function genHome(data){
    //slider
    let slides = data.slider;
    slides.forEach(el=>{
        const card = document.createElement('div');
        card.setAttribute('class', 'card');

        //image
        const image = document.createElement('img');
        image.src = el.slider_image.url;

        //slider_textarea
        const p = document.createElement('p');
        p.textContent = el.slider_textarea;

        slider.appendChild(card);
        card.appendChild(image);
        card.appendChild(p);
    });

     //content
    const contentBlock = document.createElement('div');
    const contentP = document.createElement('p');
    contentP.textContent = data.content;
    content.appendChild(contentP);

    //partners
    let ourPartners = data.our_partners;
    ourPartners.forEach(el=>{
        const image = document.createElement('img');
        image.src = el.partner.url;
        partners.appendChild(image);
    });
 }

 //showrooms
 function genShowrooms(data){
    data.forEach(el=>{
        const a = document.createElement('a');
        a.href = el.url;
        a.textContent = el.post_title;
        showrooms.appendChild(a);
        //console.log(el.url);
    });        
 }

 //hot cars
 function genCarsHot(data){
    data.forEach(el=>{
        const card = document.createElement('div');
        card.setAttribute('class', 'card');

        //image
        const image = document.createElement('img');
        image.src = el.f_img_url;
        card.appendChild(image);

        //title
        const title = document.createElement('a');
        title.href = el.url;
        title.textContent = el.post_title;
        card.appendChild(title);

        //brand, model
        const brand =  document.createElement('p');
        brand.textContent = el.brand + ', ' + el.model;
        card.appendChild(brand);

        //engine
        const engine =  document.createElement('p');
        engine.textContent = el.engine;
        card.appendChild(engine);

        //mileage
        const mileage =  document.createElement('p');
        mileage.textContent = 'mileage ' + el.mileage;
        card.appendChild(mileage);

        //price
        const price =  document.createElement('p');
        price.textContent = 'price ' + el.price;
        card.appendChild(price);
        
        hotCars.appendChild(card);
    });   
 }