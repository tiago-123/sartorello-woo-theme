"use strict";

document.addEventListener('DOMContentLoaded', () => {
    const fields = {
        personTypeField: document.querySelector('#billing_persontype_field'),
        personTypeSelect: document.querySelector('select[name="billing_persontype"]'),
        cpfField: document.querySelector('#billing_cpf_field'),
        companyField: document.querySelector('#billing_company_field'),
        cnpjField: document.querySelector('#billing_cnpj_field'),
        ieField: document.querySelector('#billing_ie_field')
    };
    // Check if the Person-Type Field exists before proceeding
    if (!fields.personTypeField) return;

    // Remove the '(optional)' text from the label of each field
    Object.values(fields).forEach(field => {
        const label = field.querySelector('label');
        if (label) {
            label.textContent = label.textContent.replace('(opcional)', '').trim();
        }
    });

    // Initialize the function to selectively hide fields
    personTypeFieldVisibility(fields);

    // Set an event listener to toggle field visibility based on user selection    
    fields.personTypeSelect.addEventListener('change', () => personTypeFieldVisibility(fields));
});

function personTypeFieldVisibility(fields) {
    const selectedPersonType = fields.personTypeSelect.value;

    if (selectedPersonType === '1') {
        fields.cpfField.classList.remove('hidden!');
        fields.companyField.classList.add('hidden!');
        fields.cnpjField.classList.add('hidden!');
        fields.ieField.classList.add('hidden!');
    } else if (selectedPersonType === '2') {
        fields.cpfField.classList.add('hidden!');
        fields.companyField.classList.remove('hidden!');
        fields.cnpjField.classList.remove('hidden!');
        fields.ieField.classList.remove('hidden!');
    }
}