let countryList = document.getElementById("countries");
let languagesList = document.getElementById("languages");


fetch("https://restcountries.com/v3.1/all")
    .then((res) => res.json())
    .then((data) => {
        // Sort the data array by country name
        data.sort((a, b) => {
            if (a.name.common < b.name.common) return -1;
            if (a.name.common > b.name.common) return 1;
            return 0;
        });

        // Create options for each country
        data.forEach(element => {
            let option = document.createElement("option");
            option.text = element.name.common;
            countryList.appendChild(option);
        });
    });    