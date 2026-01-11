$(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#phone-number').mask('0000-0000');
 })

 document.addEventListener('DOMContentLoaded', async function () {
    const select = document.getElementById('nationalitySelect');
    if (!select) return; // page doesn't have nationality select

    const selectedNationality =
        document.getElementById('selectedNationality')?.value ?? '';

    try {
        const response = await fetch('/api/countries');
        const countries = await response.json();

        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country;
            option.textContent = country;

            if (country === selectedNationality) {
                option.selected = true;
            }

            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading countries:', error);
    }
});
