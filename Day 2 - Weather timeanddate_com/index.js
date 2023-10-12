const container = document.querySelector('.container');
const search = document.querySelector('.search-box button');
const weatherBox = document.querySelector('.weather-box');
const weatherDetails = document.querySelector('.weather-details');
const error404 = document.querySelector('.not-found');

search.addEventListener('click', () => 
{
    
    let url = document.querySelector("[type='text']").value;
    
    fetch("http://localhost/scrap/info.php?loc="+url)
    .then(response => response.json())
    .then(json => 
    {
        console.log(json)
        const image = document.querySelector('.weather-box img');
        const temperature = document.querySelector('.weather-box .temperature');
        const description = document.querySelector('.weather-box .description');
        const humidity = document.querySelector('.weather-details .humidity span');
        const wind = document.querySelector('.weather-details .wind span');
        image.src = json["img"];

        temperature.innerHTML = `${json["temp"]}`;
        description.innerHTML = `${json["desc"]}`;
        humidity.innerHTML = `${json["humidity"]}`;
        wind.innerHTML = `${json["wind"]}`;

        weatherBox.style.display = '';
        weatherDetails.style.display = '';
        weatherBox.classList.add('fadeIn');
        weatherDetails.classList.add('fadeIn');
        container.style.height = '590px';
    });

});