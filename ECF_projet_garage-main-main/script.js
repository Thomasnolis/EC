
const priceRange = document.getElementById("priceRange");
const priceDisplay = document.getElementById("priceDisplay");

priceRange.addEventListener("input", updatePrice);

function updatePrice() {
    const selectedPrice = priceRange.value;
    priceDisplay.textContent = `${selectedPrice}€`;
}
const kilometerRange = document.getElementById("kilometerRange");
const kilometerDisplay = document.getElementById("kilometerDisplay");

kilometerRange.addEventListener("input", updateKilometer);

function updateKilometer() {
    const selectedkilometer = kilometerRange.value;
    kilometerDisplay.textContent = `${selectedkilometer}Km`;
}
const dateRange = document.getElementById("dateRange");
const dateDisplay = document.getElementById("dateDisplay");

dateRange.addEventListener("input", updatedate);

function updatedate() {
    const selecteddate = dateRange.value;
    dateDisplay.textContent = `${selecteddate}`;
}
