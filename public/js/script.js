const statusCheckbox = document.getElementById('statusCheckbox');
const statusCheckboxValue = document.getElementById('statusCheckboxValue');

statusCheckbox.addEventListener('change', function() {
    if(this.checked) {
        statusCheckboxValue.value = '1';
    } else {
        statusCheckboxValue.value = '0';
    }
});